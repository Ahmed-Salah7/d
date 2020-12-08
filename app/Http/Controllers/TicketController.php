<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketThread;
use App\TicketAttachment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect,Response;
use Validator;
use DB;
class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkadmin', ['only' => ['index']]);
        $this->middleware('role_or_permission:view ticket', ['only' => ['index']]);
        $this->middleware('role_or_permission:view my ticket', ['only' => ['myTicket']]);
        $this->middleware('role_or_permission:create ticket', ['only' => ['addTicket', 'store']]);
    }
   
    public function index()
    {
        return view('support.tickets.index');
    }
    
    public function myTicket()
    {   
        return view('support.tickets.my_ticket');
    }
    
    public function addTicket()
    {
        $view = view('support.tickets.add')->render(); 
        return response()->json(['view' => $view ]);
    }

    public function statusOpen()
    {
        if(request()->ajax()) {
            
            $Tickets = Ticket::leftJoin('ticket_thread', 'tickets.id', '=', 'ticket_thread.ticket_id')
            ->select(
                    'tickets.*',
                    'ticket_thread.title as thread_title'
                    )
            ->where('ticket_thread.title','!=','')
            ->where('tickets.status','1')
            ->orderBy('tickets.id', 'DESC')->get();
            return datatables()->of($Tickets)
            ->addColumn('subject', 'support.tickets.subject')
            ->addColumn('status', 'support.tickets.status')
            ->addColumn('last_replier', 'support.tickets.last_replier')
            ->addColumn('last_activity', 'support.tickets.last_activity')
            ->rawColumns(['subject','status','last_activity','last_replier'])
            ->addIndexColumn()
            ->make(true);
        }
       
    }

    public function statusClose()
    {
        if(request()->ajax()) {
            $Tickets = Ticket::leftJoin('ticket_thread', 'tickets.id', '=', 'ticket_thread.ticket_id')
            ->leftJoin('users', 'tickets.close_by', '=', 'users.id')
            ->select(
                    'tickets.*',
                    'ticket_thread.title as thread_title',
                    'users.name as username')
            ->where('ticket_thread.title','!=','')
            ->where('tickets.status','2')
            ->orderBy('tickets.id', 'DESC')->get();
            
            return datatables()->of($Tickets)
            ->addColumn('subject', 'support.tickets.subject')
            ->addColumn('status', 'support.tickets.status')
             ->addColumn('last_replier', 'support.tickets.last_replier')
            ->addColumn('last_activity', 'support.tickets.last_activity')
            ->rawColumns(['subject','status','last_activity','last_replier'])
            ->addIndexColumn()
            ->make(true);
        }
       
    }

     public function statusOpenMyTicket()
    {
        if(request()->ajax()) {
            $userID = \Auth()->user()->id;
            $Tickets = Ticket::leftJoin('ticket_thread', 'tickets.id', '=', 'ticket_thread.ticket_id')
            ->select(
                    'tickets.*',
                    'ticket_thread.title as thread_title')
            ->where('ticket_thread.title','!=','')
            ->where('tickets.status','1')
            ->where('tickets.user_id', $userID)
            ->orderBy('tickets.id', 'DESC')->get();
            return datatables()->of($Tickets)
            ->addColumn('subject', 'support.tickets.subject')
            ->addColumn('status', 'support.tickets.status')
            ->addColumn('last_replier', 'support.tickets.last_replier')
            ->addColumn('last_activity', 'support.tickets.last_activity')
            ->rawColumns(['subject','status','last_activity','last_replier'])
            ->addIndexColumn()
            ->make(true);
        }
       
    }

    public function statusCloseMyTicket()
    {
        if(request()->ajax()) {
            $userID = \Auth()->user()->id;
            $Tickets = Ticket::leftJoin('ticket_thread', 'tickets.id', '=', 'ticket_thread.ticket_id')
            ->leftJoin('users', 'tickets.close_by', '=', 'users.id')
            ->select(
                    'tickets.*',
                    'ticket_thread.title as thread_title',
                     'users.name as username')
            ->where('ticket_thread.title','!=','')
            ->where('tickets.status','2')
            ->where('tickets.user_id', $userID)
            ->orderBy('tickets.id', 'DESC')->get();
            
            return datatables()->of($Tickets)
            ->addColumn('subject', 'support.tickets.subject')
            ->addColumn('status', 'support.tickets.status')
            ->addColumn('last_replier', 'support.tickets.last_replier')
            ->addColumn('last_activity', 'support.tickets.last_activity')
            ->rawColumns(['subject','status','last_activity','last_replier'])
            ->addIndexColumn()
            ->make(true);
        }
       
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
        ],[
            'subject.required' => __('message.subject_required'),
            'message.required' => __('message.message_required'),
        ]);

        if ($validator->passes()) {
            $imageValidator = array();
            $params = $request->all();
            if( !empty($params['attachment'])){
                $imageValidator = Validator::make($request->all(), [
                    'attachment.*' => 'max:10000|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,txt'
                ],[
                    'attachment.*.max' =>__('message.attachment_size'),
                    'attachment.*.mimes' =>__('message.attachment_mimes')
                ]);
            }
           if ( empty($imageValidator) || $imageValidator->passes()  ) {
               
                $usrtID = \Auth::user()->id;
                $data   = array();
                $ticket_number ="TN".mt_rand();
                $data['user_id'] = $usrtID;
                $data['status'] = 1;
                DB::beginTransaction();
                $Ticket = Ticket::create($data);
                
                if ( $Ticket ){
                    $idColumn =  $Ticket->id;
                    $ticket_number ="TN".mt_rand();
                    $dateCode = date('ymd');
                    $newHumanCode = 'TN-'.$dateCode.substr('0000'.$idColumn, -4);
                    $Ticket->update(['ticket_number'=>$newHumanCode]);
                    try {
                        $TicketThread = TicketThread::create(['ticket_id'=>$Ticket->id,'user_id'=>$usrtID,'title'=>$params['subject'],'message'=>$params['message'] ]);
                    } catch (\PDOException $e) {
                       DB::rollback();
                        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
                    }
                    $now = Carbon::now()->format('MY');
                
                    if( !empty($params['attachment'])){
                        for( $i=0;$i<=count($params['attachment']);$i++ ) {
                            if( isset($request->attachment[$i]) ) {
                                try {
                                    $imageName = rand().'_'.$request->attachment[$i]->getClientOriginalName();
                                    $request->attachment[$i]->move(public_path('storage/attachment/'.$now), $imageName);
                                    $attachment = 'storage/attachment/'.$now.'/'.$imageName;
                                    $type = $request->attachment[$i]->getClientMimeType();
                                    $TicketAttachment = TicketAttachment::create(['name'=>$attachment,'thread_id'=>$TicketThread->id,'type'=>$type]);
                               } catch (\PDOException $e) {
                                    DB::rollback();
                                    return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
                                }
                            }
                        }
                    }
                    addToLog('create_ticket',$Ticket->id,$Ticket->id ,'Ticket');
                    $openedStatus = openedStatus('my_ticket');
                    $closedStatus = closedStatus('my_ticket');
                    DB::commit();
                    return response()->json(['success' => __('message.ticket_creatate_success').$ticket_number,'openedStatus'=>$openedStatus,'closedStatus'=>$closedStatus]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
                }
            }
            return response()->json(['error'=>$imageValidator->errors()->all()]); 
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    public function checkTicket($getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Ticket = Ticket::where('id',$id)->first();
            $TicketThreads = TicketThread::where('ticket_id',$id)->get();
            if( $Ticket ) {
                $view = view('support.tickets.check_ticket',compact('Ticket','TicketThreads'))->render();
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.ticket_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }

    public function getData($id)
    {
        $getId  = explode("-",base64_decode($id));
        $id = base64_decode($getId['1']);
        $attachment =TicketAttachment::where('id', '=', $id)->first();
        if (mime($attachment->type) == 'image') {
            echo "<img src='".asset('/'.$attachment->name)."'>";
        } else {
            $file = base64_decode($attachment->file);
            return response($file)
            ->header('Cache-Control', 'no-cache private')
            ->header('Content-Description', 'File Transfer')
            ->header('Content-Type', $attachment->type)
            ->header('Content-length', strlen($file))
            ->header('Content-Disposition', 'attachment; filename='.$attachment->name)
            ->header('Content-Transfer-Encoding', 'binary');
        }
    }

    public function addComment(Request $request,$getId)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ],[
            'message.required' => __('message.message_required'),
        ]);

        if ($validator->passes()) {
            $imageValidator = array();
            $params = $request->all();
            if( !empty($params['attachment'])){
                $imageValidator = Validator::make($request->all(), [
                    'attachment.*' => 'max:10000|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,txt'
                ],[
                    'attachment.*.max' =>__('message.attachment_size'),
                    'attachment.*.mimes' =>__('message.attachment_mimes')
                ]);
            }
            if ( empty($imageValidator) || $imageValidator->passes()  ) {
                $params = $request->all();
                $usrtID = \Auth::user()->id;
                $getId  = explode("-",base64_decode($getId));
                $id = base64_decode($getId['1']);
                if( $id != "" ) {
                    $Ticket = Ticket::where('id',$id)->first();
                    DB::beginTransaction();
                    if ( $Ticket ){
                       try {
                            $TicketThread = TicketThread::create(['ticket_id'=>$Ticket->id,'user_id'=>$usrtID,'message'=>$params['message'] ]);
                        } catch (\PDOException $e) {
                            DB::rollback();
                            return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
                        }
                        $now = Carbon::now()->format('MY');
                        if( !empty($params['attachment'])){
                            for( $i=0;$i<=count($params['attachment']);$i++ ) {
                                if( isset($request->attachment[$i]) ) {
                                    try {
                                        $imageName = rand().'_'.$request->attachment[$i]->getClientOriginalName();
                                        $request->attachment[$i]->move(public_path('storage/attachment/'.$now), $imageName);
                                        $attachment = 'storage/attachment/'.$now.'/'.$imageName;
                                        $type = $request->attachment[$i]->getClientMimeType();
                                        $TicketAttachment = TicketAttachment::create(['name'=>$attachment,'thread_id'=>$TicketThread->id,'type'=>$type]);
                                    } catch (\PDOException $e) {
                                        DB::rollback();
                                        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
                                    }
                                }
                            }
                        }

                        if( $params['page']== '') {
                            $openedStatus = openedStatus();
                            $closedStatus = closedStatus();
                        } else {
                            $openedStatus = openedStatus('my_ticket');
                            $closedStatus = closedStatus('my_ticket');
                        }
                        DB::commit();
                        addToLog('add_ticket_comment',json_encode(array("ticket_id"=>$Ticket->id) ),$Ticket->id,'Ticket');
                        return response()->json(['success' => __('message.replied_success'),'openedStatus'=>$openedStatus,'closedStatus'=>$closedStatus]);
                    } 
                    return response()->json(['error' => array('failed' =>  __('message.ticket_not_found') )]);  
                }
                return response()->json('error',  __('message.create_failed')); 
            }
            return response()->json(['error'=>$imageValidator->errors()->all()]); 
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    public function ticketClose(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        $usrtID = \Auth::user()->id;
        if( $id != "" ) {
            $Ticket = Ticket::find($id);
            if( $Ticket ) {
                $Ticket->update(['status'=>2,'close_by'=>$usrtID]);
                if( $params['page']== '') {
                    $openedStatus = openedStatus();
                    $closedStatus = closedStatus();
                } else {
                    $openedStatus = openedStatus('my_ticket');
                    $closedStatus = closedStatus('my_ticket');
                }
                addToLog('ticket_status_update',json_encode(array("ticket_id"=>$Ticket->id,'status'=>2) ),$Ticket->id,'Ticket');
                return response()->json(['success' => __('message.ticket_closed') ,'openedStatus' => $openedStatus ,'closedStatus' => $closedStatus ]);
            } else {
                return response()->json(['error' =>  __('message.ticket_not_found')]); 
            }
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }

}
