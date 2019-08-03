<html>
   <head>
      <meta charset="UTF-8">
      <title>Articles</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <!-- Bootstrap 3.3.4 -->
      <link href="{{ asset('la-assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('la-assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
      <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
      <link href="{{ asset('la-assets/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
      <!--<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
      <!-- Theme style -->
      <link href="{{ asset('la-assets/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
      <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
         page. However, you can choose any other skin. Make sure you
         apply the skin class to the body tag so the changes take effect.
         -->
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
      <link href="{{ asset('la-assets/css/skins/'.LAConfigs::getByKey('skin').'.css') }}" rel="stylesheet" type="text/css" />
      <!-- iCheck -->
      <link href="{{ asset('la-assets/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
      <script src="{{ asset('/la-assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
      <script src="{{ asset('/la-assets/js/smoothscroll.js') }}"></script>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <script src="{{ asset('la-assets/js/jquery.validate.js') }}"></script>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      @stack('styles')
   </head>
   <body>
      <div class="container">
         <div class="tab-content">
            <div class="panel infolist">
               <div class="panel-default panel-heading">
                  <h4><a href="http://adminp.local/">Home</a></h4>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-4"></div>
                     <div class="col-md-4">
                        <h1>Article Detailed Info</h1>
                     </div>
                     <div class="col-md-4"></div>
                  </div>
                  @foreach($data as $val)
                     <div class="row">
                           <div class="col-md-12">
                              <h1 class="page-header">
                                   {{$val->article_title}}
                                   <small><span class="glyphicon glyphicon-time"></span> Posted on {{date('d-M-y h:i A',strtotime($val->article_created_at))}}</small>
                               </h1>
                           <?php
                           if(!empty($val->author))
                           {
                           ?>
                        <label>Author</label> - {{$val->author}}
                        <?php
                           }
                           ?>                    
                           </div>
                     </div>
                     <?php
                     if(!empty($val->image_hash) && !empty($val->image_name))
                     {
                     ?>
                  <div class="row">
                     <div class="col-md-12">
                        <img style="height:100%;width:100%;" class="img-responsive" src="http://adminp.local/manualfiles/{{$val->image_hash}}\$val->image_name" alt=""/>
                     </div>
                  </div>
                  <?php
                     }
                     ?>
                  <div class="row">
                     <div class="col-md-12">
                        <p style="padding-left: 30px;">{{ $val->article_content }}</p>
                   </div>
                  </div>
                  @break;
                  @endforeach
               </div>
               <?php
                  if(!empty($comment) && $comment->lastPage() >= 1)
                  {
                  ?>
               <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                     <h1>Previous comments</h1>
                  </div>
                  <div class="col-md-2"></div>
               </div>
               <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                  <div id="prevcomment">
                        @foreach($comment as $val)
                        <div class="row" id="comment_section{{$val->id}}">
                           <div class="col-md-12">
                              <div class="panel panel-default">
                              <div class="panel-heading">
                                 <div class="panel-title pull-left">
                                 <strong>{{$val->anonymous_user}}</strong> <span class="text-muted">commented at {{date('d-M-y h:i A',strtotime($val->created_on))}}</span>
                                 </div>
                                 <div class="panel-title pull-right">
                                 <a href="#">
                                 <a class="btn btn-default fa fa-thumbs-o-up" onclick="likes({{$val->id}})">
                                 <input class="like_count_{{$val->id}}" readonly="readonly" type="hidden" value="{{$val->likes}}" />
                                 <span class="badge like_count_{{$val->id}}_text">{{$val->likes}}</span>
                                 </a>
                                 <a href="#">
                                 <a class="btn btn-default fa fa-thumbs-o-down" onclick="dislikes({{$val->id}})">
                                 <input class="dislike_count_{{$val->id}}" readonly="readonly" type="hidden" value="{{$val->dislikes}}" />
                                 <span class="badge dislike_count_{{$val->id}}_text">{{$val->dislikes}}</span>
                                 </a>
                                 <button class="btn btn-primary" data-toggle="modal" data-target="#ReplyModal" onclick="set_comment_id_to_reply({{$val->id}})">Reply</button>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="panel-body">
                              {{$val->comment}}
                              </div><!-- /panel-body -->
                              </div>
                           </div>
                        </div>
                        <?php
                        $comment_reply=DB::table("comments_reply")->where("comment_id",$val->id)->orderBy('created_at', 'desc')->get();
                        ?>
                        @foreach($comment_reply as $comment_reply_val)
                        <div class="row">
                           <div class="col-md-2">
                              <i class="fa fa-arrow-right pull-right" aria-hidden="true"></i>               
                           </div>
                           <div class="col-md-10">
                              <div class="panel panel-default">
                              <div class="panel-heading">
                                 <div class="panel-title">
                                 <strong>{{$comment_reply_val->anonymous_user}}</strong> <span class="text-muted">Reply on {{date('d-M-y h:i A',strtotime($comment_reply_val->created_at))}}</span>
                                 </div>
                              </div>
                              <div class="panel-body">
                              {{$comment_reply_val->comment_reply}}
                              </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
                        @endforeach
                     </div>
                  </div>
                  <div class="col-md-2"></div>
               </div>
               <?php
                  }
                  ?>

@if ($comment->lastPage() > 1)
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
<ul class="pagination">
@if ($comment->currentPage() <= 1)
    <li class="{{ ($comment->currentPage() == 1) ? ' disabled' : '' }}">
        <a>Previous</a>
    </li>
    @else
    <li class="{{ ($comment->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $comment->url(1) }}&article_id={{$data[0]->article_id}}&creator_name={{$data[0]->author}}">Previous</a>
    </li>
    @endif
    @for ($i = 1; $i <= $comment->lastPage(); $i++)
        <li class="{{ ($comment->currentPage() == $i) ? ' active' : '' }}">
            <a href="{{ $comment->url($i) }}&article_id={{$data[0]->article_id}}&creator_name={{$data[0]->author}}">{{ $i }}</a>
        </li>
    @endfor
   @if ($comment->currentPage() < $comment->lastPage())
    <li class="{{ ($comment->currentPage() == $comment->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $comment->url($comment->currentPage()+1) }}&article_id={{$data[0]->article_id}}&creator_name={{$data[0]->author}}" >Next</a>
    </li>
    @else
    <li class="{{ ($comment->currentPage() == $comment->lastPage()) ? ' disabled' : '' }}">
        <a>Next</a>
    </li>
    @endif
</ul>
</div>
</div>
@endif
               <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                     <h1>Add new comment</h1>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-4">
                     {{ Form::open(array('url'=>action('HomeController@addcomment'),'id'=>'comment_post','method'=>'post')) }}
                     <div class="form-group">
                        <label>Your Nickname</label>
                        <div class="input-group">
                           <div class="input-group-addon"><i class="fa fa-users"></i></div>
                           <input type="text" class="form-control" name="anonymous_user" id="anonymous_user" required/>	
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Comments</label>
                        <div class="input-group">
                           <div class="input-group-addon"><i class="fa fa-comment"></i></div>
                           <textarea rows="5" class="form-control" name="comment_content" id="comment_content" required></textarea>
                        </div>
                     </div>
                     <input type="hidden" id="add_comment_token" name="add_comment_token" value="{{ csrf_token() }}" />
                     <input type="hidden" id="creator_name" name="creator_name" value="{{$data[0]->author}}" />
                     <input type="hidden" id="article_id" name="article_id" value="{{$data[0]->article_id}}" />
                     <div id='recaptcha' class="g-recaptcha"
                      data-sitekey="6LcpWB0UAAAAAHBf45LMAUhaJmjzcGMZdAFMMvu_" 
                      data-callback="post_comment" 
                      data-size="invisible"></div>
                     <button class="btn btn-success bt-login" onclick="post_submit()">Add</button>
                     <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                     </ul>
                     <div class="clearfix"></div>
                     {{ Form::close() }}
                  </div>
               </div>
               <?php if(!empty($commentAdded))
                  {
                  ?>
               <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                     <div class="alert alert-warning">
                        <?php echo $commentAdded; ?>
                     </div>
                  </div>
                  <div class="col-md-2"></div>
               </div>
               <?php
                  }
                  ?>
            </div>
         </div>
      </div>
      </div>


      <div class="modal fade" id="ReplyModal" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         {{ Form::open(array('url'=>action('HomeController@replycomment'),'id'=>'comment_reply','method'=>'post')) }}
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Reply</h4>
         </div>
         <div class="modal-body">
            <div class="box-body">

                     <div class="form-group">
                        <label>Your Nickname</label>
                        <div class="input-group">
                           <div class="input-group-addon"><i class="fa fa-users"></i></div>
                           <input type="text" class="form-control" name="reply_anonymous_user" id="reply_anonymous_user" required/> 
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Reply</label>
                        <div class="input-group">
                           <div class="input-group-addon"><i class="fa fa-comment"></i></div>
                           <textarea rows="5" class="form-control" name="reply_comment_content" id="reply_comment_content" required></textarea>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <input type="hidden" id="reply_comment_token" name="reply_comment_token" value="{{ csrf_token() }}" />
                     <input type="hidden" id="comment_id" name="comment_id"/>
                    
            </div>
         </div>
         <div class="modal-footer">            
            <button type="submit" class="btn btn-success" onclick="reply_submit()">Reply</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
          {{ Form::close() }}
      </div>
   </div>
</div>
      <script>
         function likes(comment_id)
         {
            var likes_count=(parseInt($('.like_count_'+comment_id).val())+1);
            if(likes_count > 0)
            {
            var myKeyVals = { 'likes':likes_count,'comment_id':comment_id,'_token':$('#reply_comment_token').val()}
            var saveData = $.ajax({
                  type: 'post',
                  url: "http://adminp.local/likes",
                  data: myKeyVals,
                  success: function(resultData) {
                     if(resultData['status'] == "success")
                     {
                        $('.like_count_'+comment_id).val(likes_count);
                        $('.like_count_'+comment_id+'_text').html(likes_count);
                     }
                  }
            });
            saveData.error(function() { alert("Something went wrong"); });
            }
         }
     function dislikes(comment_id)
         {
         var dislike_count=(parseInt($('.dislike_count_'+comment_id).val())+1);
         if(dislike_count > 0)
         { 
         var myKeyVals = { 'dislikes':dislike_count,'comment_id':comment_id,'_token':$('#reply_comment_token').val()}
            var saveData = $.ajax({
                  type: 'post',
                  url: "http://adminp.local/dislikes",
                  data: myKeyVals,
                  success: function(resultData) {
                     if(resultData['status'] == "success")
                     {
                        $('.dislike_count'+comment_id).val(dislike_count);
                        $('.dislike_count_'+comment_id+'_text').html(dislike_count);
                     }
                  }
            });
            saveData.error(function() { alert("Something went wrong"); });
         }
     }
      $("#comment_post").validate({
         rules: {
            anonymous_user: "required",
            comment_content: "required",
            anonymous_user: {
               required: true,
               minlength: 2
            },
            comment_content: {
               required: true,
               minlength: 5
            }
         },
         messages: {
            anonymous_user: "Please enter your Nickname",
            comment_content: {
               required: "Please enter comment",
               minlength: "comment must be at least 5 characters long"
            }
         },
         submitHandler: function() {     
            grecaptcha.execute();
         }
      });
      $("#comment_reply").validate({
         rules: {
            reply_anonymous_user: "required",
            reply_comment_content: "required",
            reply_anonymous_user: {
               required: true,
               minlength: 2
            },
            reply_comment_content: {
               required: true,
               minlength: 5
            }
         },
         messages: {
            reply_anonymous_user: "Please enter your Nickname",
            reply_comment_content: {
               required: "Please enter comment",
               minlength: "comment must be at least 5 characters long"
            }
         },
         submitHandler: function() {
            reply_comment();
         }
      });
      
   </script>
      <script>
      function post_submit()
      {
         $("#comment_post").validate();
      }
      function reply_submit()
      {
         $("#comment_reply").validate();   
      }
      function reply_comment()
      {
         console.log( $('#reply_anonymous_user').val());
         var myKeyVals = { 'reply_anonymous_user' : $('#reply_anonymous_user').val(),'creator_name' : $('#creator_name').val(),'reply_comment_content' : $('#reply_comment_content').val(),'article_id':$('#article_id').val(),'comment_id':$('#comment_id').val(),'_token':$('#reply_comment_token').val()}
            var saveData = $.ajax({
                  type: 'post',
                  url: "http://adminp.local/replycomment",
                  data: myKeyVals,
                  success: function(resultData) {
                     if(resultData['comment_section_id'] > 0)
                     {
                        $("#comment_section"+resultData['comment_section_id']).after(resultData['message']);
                     }
                     $('#ReplyModal').modal('toggle');
                     $('#reply_comment_content').val('');
                  }
            });
            saveData.error(function() { alert("Something went wrong"); });
      }
      function set_comment_id_to_reply(id)
      {
         $('#comment_id').val(id);
      }
         function post_comment()
         {
         	var myKeyVals = { 'anonymous_user' : $('#anonymous_user').val(),'creator_name' : $('#creator_name').val(),'comment_content' : $('#comment_content').val(),'article_id':$('#article_id').val(),'_token':$('#add_comment_token').val()}
         	var saveData = $.ajax({
         	      type: 'post',
         	      url: "http://adminp.local/cmtajax",
         	      data: myKeyVals,
         	      success: function(resultData) {
                     if(resultData['status'] == "success")
                     { 
            	      	$('#prevcomment').prepend(resultData['message']);
                         $('#comment_content').val('');
                     }
         	      }
         	});
         	saveData.error(function() { alert("Something went wrong"); });
         }
      </script>
      <script src="{{ asset('/la-assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
   </body>
</html>