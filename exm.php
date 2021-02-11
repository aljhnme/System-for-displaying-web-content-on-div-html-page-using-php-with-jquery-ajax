<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body> 
<div class="container login-container">
  <div class="row">
    <div class="col-md-6 login-form-1">
      <h3r F>Enter the link</h3>
         <div class="form-group">
            <input type="text" id="post_content" class="form-control" placeholder="Enter the Url" value="" />
        </div>
        </div>
          <div class="col-md-6 login-form-2">
            <h3>Web interface</h3>
             <div id="link_content">
                       
            </div>
        </div>
     </div>
  </div>

</body>
<script type="text/javascript">
          $(document).on('keyup', '#post_content', function(){
        var check_content = $('#post_content').val();
        var check_url = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;

        var if_url = check_content.match(check_url);

        if(if_url)
        {   
            $('#link_content').html('wait...');
            $('#link_content').css('padding', '16px');
            $('#link_content').css('background-color', '#f9f9f9');
            $('#link_content').css('margin-bottom', '16px');
            var action = 'fetch_link_content';
            $.ajax({
                url:"showurl.php",
                method:"POST",
                data:{action:action, url:if_url},
                success:function(data)
                {
                    var title = $(data).filter("meta[property='og:title']").attr('content');
                    var description = $(data).filter("meta[property='og:description']").attr('content');

                    var image = $(data).filter("meta[property='og:image']").attr('content');

                    if(title == undefined)
                    {
                        title = $(data).filter("meta[name='fanster:title']").attr('content');
                    }

                    if(description == undefined)
                    {
                        description = $(data).filter("meta[name='fanster:description']").attr('content');
                    }

                    if(image == undefined)
                    {
                        image = $(data).filter("meta[name='fanster:image']").attr('content');
                    }
               
                var output = '<p><a href="'+if_url[0]+'">'+if_url[0]+'</a></p>';
                    
                    output += '<img style="width:100%;" src="'+image+'"/>';
                    output += '<h3><b>'+title+'</b></h3>';
                    output += '<p>'+description+'</p>';
                    $('#link_content').html(output);
                }
            })
        }
    });
</script>
</html>