<?php

namespace App\Http\Controllers;

use App\AccoumodationType;
use App\Relay;
use App\RentalRequest;
use App\TransferOfSponsorshipRequest;
use App\Worker;
use App\Profession;
use App\Nationalitie;
use App\Religion;
use App\QualificationsAndExperience;
use App\Offices;
use App\Cv;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\Log;


class WorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view worker');
        $this->middleware('role_or_permission:create worker', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit worker', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete worker', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if(request()->ajax()) {

            $Workers = Worker::used()->orderBy('workers.id', 'DESC');
            $Workers->when(request('nationality_id') != '', function ($q) {
                return $q->where('nationality_id', request('nationality_id'));
            });
            $Workers->when(request('office_id') != '', function ($q) {
                return $q->where('office_id', request('office_id'));
            });
            $Workers->when(request('profession_id') != '', function ($q) {
                return $q->where('profession_id', request('profession_id'));
            });
            $Workers->when(request('accoumodation_type_id') != '', function ($q) {
                return $q->where('accoumodation_type_id', request('accoumodation_type_id'));
            });
            $Workers->get();
            return datatables()->of($Workers)
                ->addIndexColumn()
                ->addColumn('nationality', function ($Worker){
                    return (Session::get('locale') =='en') ? $Worker->nationality->nationality_english : $Worker->nationality->nationality;
                })
                ->addColumn('profession', function ($Worker){
                    return (Session::get('locale') =='en') ?
                        $Worker->profession->job_english??'' : $Worker->profession->occupation??'';
                })
                ->addColumn('religion', function ($Worker){
                    return (Session::get('locale') =='en') ?
                        $Worker->religion->religion_english??'' : $Worker->religion->religion??'';
                })->addColumn('accoumodationType', function ($Worker){
                    return $Worker->accoumodationType->name??'';
                })->addColumn('office', function ($Worker){
                    return $Worker->office->name??'';
                })
                ->addColumn('action', 'workers.action_button')
                ->rawColumns(['action','nationality','profession'])
                ->make(true);

        }

        $Nationalities = Nationalitie::get();
        $Professions = Profession::get();
        $AccoumodationTypes = AccoumodationType::get();

        return view('workers.index',compact('Nationalities','Professions','AccoumodationTypes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Nationalities = Nationalitie::where('status','1')->get();
        $Professions = Profession::get();
        $Offices = Offices::get();
        $Religions = Religion::get();
        $QualificationsAndExperiences = QualificationsAndExperience::get();
        $AccoumodationTypes = AccoumodationType::get();

        $view = view('workers.add',compact('Nationalities','Professions','Offices'
        ,'QualificationsAndExperiences','Religions','AccoumodationTypes'))->render();

        return response()->json(['view' => $view ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sponser_name' => 'required',
            'nationality_id' => 'required',
//            'profession_id' => 'required',
            'age' => 'required',
            'enter_date' => 'required',
            'passport_number' => 'required',
            'office_id' => 'required',
            'accoumodation_type_id' => 'required',
            'religion_id' => 'required',
            'qualifications_and_rxperience_id' => 'required',
            'passport_image' => 'image',
//            'additional_attchements' => 'required',
//            'notes' => 'required',
        ]
        ,[
            'name.required' => __('message.name_required'),
            'sponser_name.required' => __('message.sponser_name_required'),
            'nationality_id.required' => __('message.nationality_required'),
            'age.required' => __('message.age_required'),
            'enter_date.required' => __('message.enter_date_required'),
            'passport_number.required' => __('message.passport_number_required'),
            'office_id.required' => __('message.office_required'),
            'accoumodation_type_id.required' => __('message.accoumodation_type_required'),
            'religion_id.required' => __('message.religion_required'),
            'qualifications_and_rxperience_id.required' => __('message.qualifications_and_rxperience_required'),
            'passport_image.required' => __('message.passport_image_required'),
        ]
        );

        if ($validator->passes()) {
            $params = $request->all();
            $Worker = Worker::create($params);

            $now = Carbon::now()->format('MY');

            if($request->additional_attchements) {
                $imageName = rand() . '_' . $request->additional_attchements->getClientOriginalName();
                $request->additional_attchements->move(public_path('storage/additional_attchements/' . $now), $imageName);
                $additional_attchements = 'storage/additional_attchements/' . $now . '/' . $imageName;
                $Worker->additional_attchements = $additional_attchements;
            }

            if($request->passport_image) {
                $imageName = rand() . '_' . $request->passport_image->getClientOriginalName();
                $request->passport_image->move(public_path('storage/passport_image/' . $now), $imageName);
                $passport_image = 'storage/passport_image/' . $now . '/' . $imageName;
                $Worker->passport_image = $passport_image;
            }
            $Worker->save();

            if ($Worker){
                addToLog('add_worker',$Worker->id,$Worker->id ,'Worker');
                return response()->json(['success' => __('message.create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);
            }

        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {

        $id = $getId;
        if( $id != "" ) {
            $worker = Worker::where('id',$id)->first();
            if( $worker ) {
                $Nationalities = Nationalitie::where('status','1')->get();
                $Professions = Profession::get();
                $Offices = Offices::get();
                $Religions = Religion::get();
                $QualificationsAndExperiences = QualificationsAndExperience::get();
                $AccoumodationTypes = AccoumodationType::get();

                $view = view('workers.edit',compact('Nationalities','Professions','Offices'
                    ,'QualificationsAndExperiences','Religions','worker','AccoumodationTypes'))->render();

                return response()->json(['view' => $view ]);
            } else {
               return response()->json('error', __('message.customer_not_found'));
            }
        }
        return response()->json('error',  __('message.create_failed'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {

        $validator = Validator::make($request->all(), [
                'name' => 'required',
                'sponser_name' => 'required',
                'nationality_id' => 'required',
//            'profession_id' => 'required',
                'age' => 'required',
                'enter_date' => 'required',
                'passport_number' => 'required',
                'office_id' => 'required',
                'accoumodation_type_id' => 'required',
                'religion_id' => 'required',
                'qualifications_and_rxperience_id' => 'required',
                'passport_image' => 'image',
//            'additional_attchements' => 'required',
//            'notes' => 'required',
            ]
            ,[
                'name.required' => __('message.name_required'),
                'sponser_name.required' => __('message.sponser_name_required'),
                'nationality_id.required' => __('message.nationality_required'),
                'age.required' => __('message.age_required'),
                'enter_date.required' => __('message.enter_date_required'),
                'passport_number.required' => __('message.passport_number_required'),
                'office_id.required' => __('message.office_required'),
                'accoumodation_type_id.required' => __('message.accoumodation_type_required'),
                'religion_id.required' => __('message.religion_required'),
                'qualifications_and_rxperience_id.required' => __('message.qualifications_and_rxperience_required'),
                'passport_image.required' => __('message.passport_image_required'),
            ]
        );

        if ($validator->passes()) {
            $params = $request->all();
            $id = $getId;
            if( $id != "" ) {
                $Worker = Worker::where('id',$id)->first();

                if( $Worker ) {

                    $Worker->update($params);
                    $now = Carbon::now()->format('MY');

                    if($request->additional_attchements) {
                        $imageName = rand() . '_' . $request->additional_attchements->getClientOriginalName();
                        $request->additional_attchements->move(public_path('storage/additional_attchements/' . $now), $imageName);
                        $additional_attchements = 'storage/additional_attchements/' . $now . '/' . $imageName;
                        $Worker->additional_attchements = $additional_attchements;
                    }

                    if($request->passport_image) {
                        $imageName = rand() . '_' . $request->passport_image->getClientOriginalName();
                        $request->passport_image->move(public_path('storage/passport_image/' . $now), $imageName);
                        $passport_image = 'storage/passport_image/' . $now . '/' . $imageName;
                        $Worker->passport_image = $passport_image;
                    }
                    
                    $Worker->save();
                    $params['id'] = $Worker->id;
                    addToLog('edit_worker',serialize($params),$Worker->id ,'Worker');
                    return response()->json(['success' => __('message.update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.not_found') )]);
                }
            }
           return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $id = $params['id'];
        if( $id != "" ) {
            $Worker = Worker::find($id);
            if( $Worker ) {
                $Worker->delete();
                addToLog('delete_worker',$Worker->id,$Worker->id ,'Worker');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.not_found') )]);
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);
    }


	
}
