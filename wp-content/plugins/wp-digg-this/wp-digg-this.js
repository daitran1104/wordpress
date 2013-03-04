jQuery(document).ready(function($) {

    $.each($("span.md5hash"), function () {
      var elem = $(this);
      $.ajax({ type:      "GET",
               dataType:  "jsonp",
               url:       "http://feeds.delicious.com/v2/json/urlinfo/"+$(this).html(),
               success:   function(data){
                            if (data.length > 0) {
                              elem.next().prepend(data[0].total_posts + " ");
                            }
                          }
            });
    });

  });