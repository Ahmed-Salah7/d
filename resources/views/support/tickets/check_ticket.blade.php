<div class="card mb-0">
    <div class="card-body pb-0 pt-0 pr-0">
        <div class="row">
        	<div class="col-6">
	        	<h6><i class="fas fa-user"></i> ({{ $Ticket->ticket_number }} - {{ $TicketThreads[0]['title'] }}) </h6>
	       	</div>
	       	<div class="col-6 text-right">
        		@if( $Ticket->status == 1 )
        		<button type="button" class="btn btn-primary btn-sm waves-effect waves-light ticket_colse" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Ticket->id)) }}">{{ __('page.ticket_colse') }}</button>
        		@else
        		<label>{{ __('page.close_by') }}:</label><span>{{ $Ticket->User->name }}</span>
        		@endif
        	</div>	
        </div>
        <hr>
        <div class="row">
        	@if( count($TicketThreads) > 0 )
    			@foreach( $TicketThreads as $TicketThread )
        			<div class="col-12" >
        				<div class="card mb-3 text-white @if( $Ticket->user_id == $TicketThread->user_id ) bg-primary @else bg-success @endif">
                            <div class="card-body pt-1 pb-1">
                                <blockquote class="card-bodyquote mb-0">
                                   	<h6 class="mb-0">{{ $TicketThread->user->name }}</h4>
        							<span><i class="far fa-clock"></i> {{ $TicketThread->created_at }}</span>
                                </blockquote>
                            </div>
                        </div>
        				<div class="col-12">
        					{{ $TicketThread->message }}
        					@php 
        						$getAttachments = getAttachment($TicketThread->id);
        					@endphp
        					@if( count($getAttachments) > 0 )
        						<div class="mt-1 attachment-border">
	        						<h6> {{ count($getAttachments) }} {{ __('page.attachments') }}</h6>
	        						<div class="row">
		        						@foreach( $getAttachments as $getAttachment )
		        							<div class="col-2 col-lg-1 col-md-1 mt-3 text-center attachment-padding">
				        						<a href="{{ url('/support/ticket/image/'.base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($getAttachment->id))) }}" target="_blank">
				        						@if( mime($getAttachment->type) == 'image' )
                                               		<img src="{{ asset('/'.$getAttachment->name) }}" class="img-thumbnail">
                                               	@elseif( mime($getAttachment->type) == 'pdf' )
                                               		<i class="fas fa-file-pdf fa-3x	"></i>
                                               	@elseif( mime($getAttachment->type) == 'doc' )
                                               		<i class="fas fa-file-word fa-3x"></i>
                                               	@elseif( mime($getAttachment->type) == 'text' )
                                              		<i class="fas fa-file-alt  fa-3x"></i>
                                               	@endif
				        						<!-- <div>{{ basename($getAttachment->name) }}</div> -->
				        						</a>
				        					</div>
				        				@endforeach
				        			</div>
				        		</div>
        					@endif
	        			</div>
        				<div class="erp-ticket-bottom-border"></div>
        			</div>
				@endforeach
    		@endif
    	</div>
    	@if( $Ticket->status == 1 )
    		@include('includes.form_error')
	    	<form method="POST" id="add_comment" autocomplete="off" enctype="multipart/form-data"> 
	            {{ csrf_field() }}
	            <div class="row">
	            	<div class="col-md-12">
	                    <div class="form-group">
	                        <label>{{ __('page.leave_a_reply') }}</label>
	                       <textarea class="form-control" rows="5" id="message" name="message"></textarea> 
	                    </div>
	                </div>
	                <div class="col-md-12">
	                    <div class="form-group">
	                        <label>{{ __('page.attachment') }}</label><br>
	                      <input type="file" name="attachment[]" multiple="multiple">
	                    </div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="form-group mb-0">
	                        <button type="submit" class="btn btn-primary" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Ticket->id)) }}">{{ __('page.add_comment') }} <i class="fas "></i></button>
	                    </div>
	                </div>
	            </div>
	        </form>
	    @endif
    </div>
</div>