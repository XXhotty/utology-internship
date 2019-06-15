let id = document.getElementById('videoId').value;
let comments = document.getElementById('Jcomments').value;
console.log(comments);
count = 0;
videoTime = 0;
var nextComment = comments[videoTime];

window.onload = function() {
    target = document.getElementById("output");
};

var video_play = function() {
    empty = " ";
    video.play();
    var countup = function(){
        comment = "";
        Vcount = count + 1;
        console.log("Vcount");
        console.log(Vcount);
        while (Vcount > nextComment.time){
            console.log("nextComment");
            console.log(nextComment.time);
            comment = comment + ' ' + nextComment.comment;
            nextComment = comments[++videoTime];
        }
        if(comment != ''){
            target.innerHTML = comment;
        }
        else {
            target.innerHTML = empty;
        }
        console.log("count");
        console.log(count++);
        console.log("comment");
        console.log(comment);
        return count;
    };
    I = setInterval(countup, 1000);
    return count;
};

function video_pause() {
    video.pause();
    clearInterval(I);
}
function comment_ajax() {
    let newComment = document.getElementById('comment').value;
    console.log(newComment);
    commentCount = count -1;
    $.ajax({
        url : "/utology-internship/api/VideoPlayApi.php",
        type : "POST",
        data : {post_data_1:id, post_data_2:newComment, post_data_3:commentCount}
    }).done(function(response, textStatus, xhr) {
        console.log("ajax通信に成功しました");
        console.log(response[0]);
        console.log(response[1]);
        console.log(response[2]);
        /*
        $("#response0").text(response[0]);
        $("#response1").text(response[1]);
        $("#response2").text(response[2]);
        */
        comment = comment + ' ' + response[1];
        target.innerHTML = comment;
    }).fail(function(xhr, textStatus, errorThrown) {
        console.log("ajax通信に失敗しました");
    });
}
/* var commentView = function () {
     count = 0;
     var nextComment = comments[0];
      while (1){
          if(video.pos > nextComment.time) {
              // 表示
              count++;
          }
      }
  }*/
