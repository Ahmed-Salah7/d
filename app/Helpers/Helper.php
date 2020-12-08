<?php
use App\LogActivity;
use App\Ticket;
use App\TicketThread;
use App\TicketAttachment;
use App\Invoice;
use App\invoicePayment;
use App\EmploymentContract;
use App\Status;

if (!function_exists('addToLog')) {
    function addToLog($key,$value,$id=0,$model=null)
    {
    	$log = [];
    	$log['user_id'] = auth()->user()->id;
    	$log['username'] = auth()->user()->username;
        $log['key'] = $key;
        $log['value'] = $value;
        $log['model_id'] = $id;
        $log['model'] = $model;
        LogActivity::create($log);

    }
}

if (!function_exists('openedStatus')) {
    function openedStatus($myTicket="" )
    {
    	$userID = \Auth()->user()->id;
    	if( $myTicket !="" ) {
    		$openedStatus = Ticket::where('status','1')->where('user_id',$userID)->count();
    	} else {
    		$openedStatus = Ticket::where('status','1')->count();
    	}

    	return $openedStatus;
 	}
}

if (!function_exists('closedStatus')) {
    function closedStatus($myTicket="")
    {
    	$userID = \Auth()->user()->id;
    	if( $myTicket !="" ) {
    		$closedStatus = Ticket::where('status','2')->where('user_id',$userID)->count();
    	} else {
    		$closedStatus = Ticket::where('status','2')->count();
    	}
    	return $closedStatus;
 	}
}

if (!function_exists('countThreadMessage')) {
    function countThreadMessage($id)
    {
    	$countThreadMessage = TicketThread::where('ticket_id',$id)->count();
    	return $countThreadMessage;
 	}
}

if (!function_exists('getLastthreadReplier')) {
    function getLastthreadReplier($id)
    {
    	$getLastthreadReplier = TicketThread::where('ticket_id',$id)->get()->last();
    	return $getLastthreadReplier->User->name;
 	}
}

if (!function_exists('getLastthreadActivity')) {
    function getLastthreadActivity($id)
    {
    	$getLastthreadActivity = TicketThread::where('ticket_id',$id)->get()->last();
    	return $getLastthreadActivity->created_at;
 	}
}

if (!function_exists('getAttachment')) {
    function getAttachment($id)
    {
        $getAttachment = TicketAttachment::where('thread_id',$id)->get();
        return $getAttachment;
    }
}
if (!function_exists('invoicePaid')) {
    function invoicePaid($id ,$Balance ='')
    {
        $invoicePayment = invoicePayment::where('invoice_id',$id)->sum('amount_paid');
        if( $Balance !="" ){
            $Invoice = Invoice::where('id',$id)->first();
            $invoicePayment = $Invoice->grand_total - $invoicePayment;
        }
        return number_format($invoicePayment,2);
    }
}

if (!function_exists('getInvoicesStatus')) {
    function getInvoicesStatus($id)
    {
        $invoicePayment = invoicePayment::where('invoice_id',$id)->sum('amount_paid');
        $Invoice = Invoice::where('id',$id)->first();
        $status ="";
        if( $invoicePayment !="" ){
            if( $invoicePayment >= $Invoice->grand_total){
                $Invoice->update(['status'=>3]);
            } else {
                $Invoice->update(['status'=>5]);
            }
        }
    }
}

if (!function_exists('getPaidAmount')) {
    function getPaidAmount($id,$Amount="")
    {
        $invoicePayment = invoicePayment::where('invoice_id',$id)->sum('amount_paid');
        $Invoice = Invoice::where('id',$id)->first();
        $totalAmount =  $Invoice->grand_total - $invoicePayment;
        if( $Amount !="" ){
            $totalAmount = $totalAmount + $Amount;
        }
        return $totalAmount;
    }
}
if (!function_exists('mime')) {
    function mime($type)
    {
        if ($type == 'jpg' ||
                $type == 'png' ||
                $type == 'PNG' ||
                $type == 'JPG' ||
                $type == 'jpeg' ||
                $type == 'JPEG' ||
                $type == 'gif' ||
                $type == 'GIF' ||
                $type == 'image/jpeg' ||
                $type == 'image/jpg' ||
                $type == 'image/gif' ||
                $type == 'image/png' ||
                starts_with($type, 'image')) {
            return 'image';
        }elseif($type == 'pdf' ||
                $type == 'application/pdf') {
             return 'pdf';
        }elseif($type == 'doc' ||
                $type == 'docx' ||
                $type == 'application/msword' ||
                starts_with($type, 'application')) {
             return 'doc';
        }elseif($type == 'txt' ||
                $type == 'text/plain' ||
                starts_with($type, 'text')) {
             return 'text';
        }
    }
}

function get_user_by_token($token){
    $records =  DB::table('password_resets')->get();
    foreach ($records as $record) {
        if (Hash::check($token, $record->token) ) {
           return $record;
        }
    }
}
if (!function_exists('getOfficeLocation')) {
    function getOfficeLocation($id,$type){
        $extraData = EmploymentContract::select('extradata')->where('id',$id)->first();
        $Status = '';
        if( $extraData !="" ) {
            $extraDataId = json_decode($extraData['extradata'], true);
            if( !empty($extraDataId) ) {
                $extraDataId = array_values($extraDataId);
                $Status = Status::whereIn('id',$extraDataId)->where('office_type',$type)->pluck('name')->toArray();
                $Status = implode(',',$Status);
            }
        }
        return $Status;
    }
}
if (!function_exists('getContractNum')) {
    function getContractNum(){
        $contractCount = 0;
        $extraData = EmploymentContract::count();
        if( $extraData > 0 ) {
            $contractCount = $extraData + 1;
        } else {
            $contractCount = $contractCount + 1;
        }
        return $contractCount;
    }
}


