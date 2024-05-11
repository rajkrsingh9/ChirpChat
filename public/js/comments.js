$.ajax({
  url: "/friends",
  success: function (data) {
    data.userOnline.forEach(function (user) {
      console.log(user);
      addOnlineFriends(user);
    });
  },
});

// For adding online users.
function addOnlineFriends(user) {
  if (user.status == "0") {
    $("#onlinefriendsup").append(
      '<div class="onlineuser"> <img src="' +
        user.img +
        '" class="image" /> <p>' +
        user.firstname +
        " " +
        user.lastname +
        '</p> <div class="dot"></div></div>'
    );
  } else {
    $("#onlinefriendsdown").append(
      '<div class="onlineuser"> <img src="' +
        user.img +
        '" class="image" /> <p>' +
        user.firstname +
        " " +
        user.lastname +
        '</p> <div class="dot dOnline"></div></div>'
    );
  }
}

function tag() {
  var comment = $("#commentValue" + i).val();
}

function acceptRequest(id) {
  var id = id;
  console.log(id);
  $.ajax({
    url: "/accept",
    type: "POST",
    data: {
      id: id,
    },
    success: function (data) {
      console.log(data);
      $("#addRequest" + id).hide();
      $("#rejectRequest" + id).hide();
    },
    error: function (xhr, status, error) {
      alert(xhr.responseText);
    },
  });
}

function rejectRequest(id) {
  var id = id;
  console.log(id);
  $.ajax({
    url: "/reject",
    type: "POST",
    data: {
      id: id,
    },
    success: function (data) {
      console.log(data);
      $("#noti" + id).remove();
    },
    error: function (xhr, status, error) {
      alert(xhr.responseText);
    },
  });
}

function addNotification(allRequestNotification) {
  $("#listNotifications").append(
    `<li id="noti` +
      allRequestNotification.userId +
      `" class="noti"><img src="` +
      allRequestNotification.img +
      `" class="image" /> <p>` +
      allRequestNotification.firstname +
      " " +
      allRequestNotification.lastname +
      `</p>
<button onclick="acceptRequest(` +
      allRequestNotification.userId +
      `)" id="addRequest` +
      allRequestNotification.userId +
      `">
Accept</button>
<button onclick="rejectRequest(` +
      allRequestNotification.userId +
      `)" id="rejectRequest` +
      allRequestNotification.userId +
      `" >
Reject</button></li>`
  );
}
$("#notifications").hover(
  function () {
    $("#allNotifications").show("slow");
    $.ajax({
      url: "/notifications",
      success: function (data) {
        if (data != "noNotification") {
          data.noti.forEach(function (allRequestNotification) {
            addNotification(allRequestNotification);
          });
        } else {
          console.log(data);
        }
      },
      error: function (xhr, status, error) {
        alert(xhr.responseText);
      },
    });
  },
  function () {
    $("#allNotifications").hide("slow");
    $("#listNotifications").html("");
  }
);

// For cancle friend request
function cancleRequest(id) {
  var id = id;
  $.ajax({
    url: "/cancleFriendRequest",
    type: "POST",
    data: {
      id: id,
    },
    success: function (data) {
      if (data == "done") {
        $("#cancleFriendRequest" + id).hide("fast");
        $("#friendRequest" + id).show("fast");
      }
    },
    error: function (xhr, status, error) {
      alert(xhr.responseText);
    },
  });
}

// Fore send friend request
function sendRequest(id) {
  var id = id;
  $.ajax({
    url: "/sendFriendRequest",
    type: "POST",
    data: {
      id: id,
    },
    success: function (data) {
      console.log(data);
      if (data == "done") {
        $("#friendRequest" + id).hide("fast");
        $("#cancleFriendRequest" + id).show("fast");
      }
    },
    error: function (xhr, status, error) {
      alert(xhr.responseText);
    },
  });
}

// For search friend.
var userList = null;
function allFriends() {
  var input = $("#searchbar").val();
  $("#list").html("");
  input = input.toLowerCase();
  $("#searchlist").show("slow");
  if (userList) {
    userList.userOnline.forEach(function (user) {
      full = user.firstname.toLowerCase();
      if (full.indexOf(input) != -1) {
        showAllSearch(user);
      }
    });
  } else {
    $.ajax({
      url: "/searchFriend",
      success: function (data) {
        userList = data;
        data.userOnline.forEach(function (user) {
          full = user.firstname.toLowerCase();
          if (full.indexOf(input) != -1) {
            showAllSearch(user);
          }
        });
      },
    });
  }
}

$("#searchbar").focus(function () {
  $("#list").css("display", "block");
});
// $('#list').focus(function () {
//   $('#userFriends').css('display', 'block');
// })
$("#searchbar").focusout(function () {
  setTimeout(function () {
    $("#list").css("display", "none");
  }, 500);
});

// $('#userFriends').on("click", function () {
//   $('#list').css('display', 'block');
// });

function showAllSearch(user) {
  console.log(user.requestStatus);
  var dis = "none";
  var disagain = "block";
  var accept = "none";
  var reject = "none";
  var mess = "none";
  if (user.requestStatus == "send") {
    dis = "block";
    disagain = "none";
  }
  if (user.requestStatus == "received") {
    dis = "none";
    disagain = "none";
    accept = "block";
    reject = "block";
  }
  if (user.requestStatus == "accepted") {
    dis = "none";
    disagain = "none";
    accept = "none";
    reject = "none";
    mess = "block";
  } else if (user.requestStatus == "received") {
  }
  $("#list").append(
    `<li id="userFriends"><img src="` +
      user.img +
      `" class="image" /> <p>` +
      user.firstname +
      " " +
      user.lastname +
      `</p>
 <button onclick="sendRequest(` +
      user.id +
      `)" id="friendRequest` +
      user.id +
      `" style="display:` +
      disagain +
      `">
 Send Request</button>
 <button onclick="cancleRequest(` +
      user.id +
      `)" id="cancleFriendRequest` +
      user.id +
      `" style="display:` +
      dis +
      `">
 Cancle Request</button>
 <button onclick="acceptRequest(` +
      user.requestId +
      `)" id="addRequest` +
      user.requestId +
      `" style="display:` +
      accept +
      `" >
Accept</button>
<button onclick="rejectRequest(` +
      user.requestId +
      `)" id="rejectRequest` +
      user.requestId +
      `" style="display:` +
      reject +
      `" >
Reject</button>
<button onclick="sendMessage(` +
      user.requestId +
      `)" id="sendMess` +
      user.requestId +
      `" style="display:` +
      mess +
      `" >
Message</button></li>`
  );
}

// For EditProfile.
$("#EditProfile").on("click", function (e) {
  $("#editDel").submit(function (f) {
    f.preventDefault();
    formdata = new FormData(this);
    var fileData = $('input[type="file"]')[0].files[0];
    formdata.append("image", fileData);
    validation = checkValidation(formdata);
    if (validation) {
      $.ajax({
        url: "/editProfile",
        type: "POST",
        data: formdata,
        contentType: false,
        processData: false,
        success: function (data) {
          if (data == "done") {
            $("#subsignup").trigger("reset");
            window.location.href = "http://chirpchat.com/";
          } else {
            $("#error").html(data);
          }
        },
        error: function (xhr, status, error) {
          alert(xhr.responseText);
        },
      });
    } else {
      $("#error").html(validation);
    }
  });
});

// Validations
function checkValidation(formdata) {
  var correctName = /^([A-Za-z])+$/;
  var about = formdata.get("abotYou");
  about = about.replace(/<[^>]+>/gim, "");
  var correctPassword = /([a-zA-Z0-9]){8,}$/;
  if (
    !correctName.test(formdata.get("fname")) ||
    !correctName.test(formdata.get("lname"))
  ) {
    return "format of name is not correct";
  }
  // else if(!correctPassword.test(formdata.get("pass"))) {
  //   return "password should be minimum 8 character";
  // }
  else if (formdata.get("pass").length < 8) {
    return "password should be minimum 8 character";
  }
  return "TRUE";
}

// For sending reset password link.
$("#resetPass").on("click", function (e) {
  $(".loader-div").show();
  e.preventDefault();
  let email = $("#emailId").val();
  $.ajax({
    url: "/ResetPass",
    type: "POST",
    data: {
      email: email,
    },
    success: function (data) {
      $("#error").html(data);
      $(".loader-div").hide();
    },
  });
});

// For reseting password.
$("#resetP").on("click", function (e) {
  $(".loader-div").show();
  var token = this.getAttribute("token");
  e.preventDefault();
  let pass = $("#pass").val();
  let cpass = $("#cpass").val();
  if (pass == cpass) {
    $.ajax({
      url: "/PasswordR",
      type: "POST",
      data: {
        pass: pass,
        cpass: cpass,
        token: token,
      },
      success: function (data) {
        $("#error").html(data);
        $(".loader-div").hide();
        window.location.href = "http://127.0.0.1:8000/";
      },
    });
  } else {
    $("#error").html("Password and confirm password does not match");
    $(".loader-div").hide();
  }
});

// For logout.
function logout() {
  $.ajax({
    url: "/logout",
    type: "POST",
    success: function (data) {
      window.location.href = "http://127.0.0.1:8000/";
    },
  });
}

// For likeing post.
function like(i) {
  let a = $("#likeIcon" + i);
  let b = a.css("color");
  let c = "rgb(0, 0, 0)";
  let d = "rgb(0, 0, 255)";
  if (b === c) {
    $("#dislikeIcon" + i).css("color", "black");
    $("#likeIcon" + i).css("color", "blue");
    $("#dislikebutton" + i).attr("disabled", "disabled");
    dis = 1;
    $.ajax({
      url: "/like",
      type: "POST",
      data: {
        dis: dis,
        id: i,
      },
      success: function (data) {
        $("#likeText" + i).text(data);
      },
    });
  } else {
    if (b === d) {
      $("#likeIcon" + i).css("color", "black");
      $("#dislikeIcon" + i).css("color", "black");
      $("#dislikebutton" + i).removeAttr("disabled");
      dis = 1;
      $.ajax({
        url: "/likeRemove",
        type: "POST",
        data: {
          dis: dis,
          id: i,
        },
        success: function (data) {
          $("#likeText" + i).text(data);
        },
      });
    }
  }
}

// For disliking post.
function dislike(i) {
  let a = $("#dislikeIcon" + i);
  let b = a.css("color");
  let c = "rgb(0, 0, 0)";
  let d = "rgb(0, 0, 255)";
  if (b === c) {
    $("#dislikeIcon" + i).css("color", "blue");
    $("#likeIcon" + i).css("color", "black");
    $("#likebutton" + i).attr("disabled", "disabled");
    dis = 1;
    $.ajax({
      url: "/dislike",
      type: "POST",
      data: {
        dis: dis,
        id: i,
      },
      success: function (data) {
        $("#dislikeText" + i).text(data);
      },
    });
  } else {
    if (b === d) {
      $("#likeIcon" + i).css("color", "black");
      $("#dislikeIcon" + i).css("color", "black");
      $("#likebutton" + i).removeAttr("disabled");
      dis = 1;
      $.ajax({
        url: "/dislikeRemove",
        type: "POST",
        data: {
          dis: dis,
          id: i,
        },
        success: function (data) {
          $("#dislikeText" + i).text(data);
        },
      });
    }
  }
}

// Modal for edit comment.
function displayEditCommModal(i) {
  $("#myCommentModal" + i).show("slow");
}
// For hiding modal.
function hideEditCommentModal(i) {
  $("#myCommentModal" + i).hide("slow");
}

// After editing comment it will store in database.
function confirmCommentEdit(i) {
  var afterEdit = $("#confirmCommentEditValue" + i).val();
  $.ajax({
    url: "/editComm",
    type: "POST",
    data: {
      afterEdit: afterEdit,
      i: i,
    },
    success: function (data) {
      if (data == "done") {
        $("#commValue" + i).text(afterEdit);
        hideEditCommentModal(i);
      }
    },
  });
}

// For showing comment data.
function showCommentData(comm, i) {
  var dis = "";
  if (comm.email != comm.loginEmail) {
    dis = "none";
  }
  $("#commentD" + i).append(
    `
    <div id="commTop` +
      comm.id +
      `" class="commz">
      <div class="posttop" id="commentTop` +
      comm.id +
      `">
  <img src="` +
      comm.img +
      `"  class="smallimg" />
  <h3>` +
      comm.firstname +
      " " +
      comm.lastname +
      `</h3>
  <div class="dropdown" style="display:` +
      dis +
      `">
    <i class="fa fa-ellipsis-v"></i>
    <div class="dropdown-content">
      <button id="editComm` +
      comm.id +
      ` " onclick="displayEditCommModal(` +
      comm.id +
      `)">Edit</button>
      <button id="DeleteComm` +
      comm.id +
      `" onclick="DeleteComm(` +
      comm.id +
      `)">Delete</button>
    </div>
  </div>
</div>
<p id="commValue` +
      comm.id +
      `">` +
      comm.title +
      `</p>  
      </div>
<div id="myCommentModal` +
      comm.id +
      `" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
    <button class="close" id="closeEditComment` +
      comm.id +
      `" onclick="hideEditCommentModal(` +
      comm.id +
      `)">&times;</button>
    <input type="text" name="EditComment" class="editText" value="` +
      comm.title +
      `" id="confirmCommentEditValue` +
      comm.id +
      `" required />
    <button class="confirm" id="confirmComment` +
      comm.id +
      `" onclick="confirmCommentEdit(` +
      comm.id +
      `)">Confirm</button>
    </div>
    </div>
`
  );
}

// For showing all the comments.
function showComment(i) {
  $("#comm" + i).show("slow");
  $("#commentbut" + i).hide();
  $("#hide" + i).show("slow");
  var id = i;
  $.ajax({
    url: "/addComment",
    type: "POST",
    data: {
      i: id,
    },
    success: function (data) {
      if (data) {
        data.comm.forEach(function (comm) {
          showCommentData(comm, id);
        });
      }
    },
    error: function (xhr, status, error) {
      alert(xhr.responseText);
    },
  });
}

// For hiding comments.
function hideComment(i) {
  $("#comm" + i).hide();
  $("#hide" + i).hide();
  $("#commentbut" + i).show("slow");
  $(".commz").remove();
}

// For deleting post.
function DeletePost(i) {
  $.ajax({
    url: "/deletePost",
    type: "POST",
    data: {
      i: i,
    },
    success: function (data) {
      if (data == "done") {
        $("#post" + i).remove();
      }
    },
  });
}

// Display the modal for editing posts.
function displayEditModal(i) {
  $("#myModal" + i).show("slow");
}
// hiding the modal after clicking on (X).
function hideEditModal(i) {
  $("#myModal" + i).hide("slow");
}

// After editing post saving changes.
function confirmEdit(i) {
  var afterEdit = $("#confirmEditValue" + i).val();
  $.ajax({
    url: "/editPost",
    type: "POST",
    data: {
      afterEdit: afterEdit,
      i: i,
    },
    success: function (data) {
      if (data == "done") {
        $("#postValue" + i).text(afterEdit);
        hideEditModal(i);
      }
    },
  });
}

// Add comments.
function addComment(i) {
  var comment = $("#commentValue" + i).val();
  var comment = comment.replace(/<[^>]+>/gim, "");
  $.ajax({
    url: "/addComment",
    type: "POST",
    data: {
      i: i,
      addComment: comment,
    },
    success: function (data) {
      s = data.comm.length;
      showCommentData(data.comm[s - 1], i);
      $("#commentValue" + i).val("");
    },
  });
}

// Delete comment.
function DeleteComm(i) {
  $.ajax({
    url: "/deleteComm",
    type: "POST",
    data: {
      i: i,
    },
    success: function (data) {
      if (data == "done") {
        $("#commTop" + i).remove();
      }
    },
  });
}

$(document).ready(function () {
  // Hiding resend otp button
  $("#resendotp").hide();

  // If emailId and password are correct then it will open home page.
  $("#login").on("click", function (e) {
    e.preventDefault();
    var email = $("#emailId").val();
    var pass = $("#pass").val();
    $.ajax({
      url: "/login",
      type: "POST",
      data: {
        email: email,
        pass: pass,
      },
      success: function (data) {
        if (data == "done") {
          window.location.href = "http://127.0.0.1:8000/";
        } else {
          $("#error").html(data);
        }
      },
    });
  });

  // For creating a new user account.
  $("#signup").on("click", function (e) {
    $("#subsignup").submit(function (f) {
      f.preventDefault();
      formdata = new FormData(this);
      var fileData = $('input[type="file"]')[0].files[0];
      var fileData2 = $('input[type="file"]')[0].files[1];
      formdata.append("image", fileData);
      formdata.append("authLetter", fileData2);
      console.log(formdata);
      validation = checkValidation(formdata);
      if (validation == "TRUE") {
        $.ajax({
          url: "/newAccount",
          type: "POST",
          data: formdata,
          contentType: false,
          processData: false,
          success: function (data) {
            if (data == "done") {
              $("#subsignup").trigger("reset");
              window.location.href = "http://127.0.0.1:8000/";
            } else {
              $("#error").html(data);
            }
          },
        });
      } else {
        $("#error").html(validation);
      }
    });
  });

  // For enabling and disabling resend otp button.
  function resendotp() {
    $("#resendotp").removeAttr("disabled");
    clearInterval(time);
  }

  // For sending otp message.
  $(".loader-div").hide();
  $("#otpb").on("click", function (e) {
    $(".loader-div").show();
    e.preventDefault();
    var email = $("#emailId").val();
    $.ajax({
      url: "/otpSend",
      type: "POST",
      data: {
        email: email,
      },
      success: function (data) {
        if (data == "OTP Send to your email address") {
          $("#otpb").hide();
          $("#resendotp").show();
          $("#error").html(data);
          $(".loader-div").hide();
          time = setInterval(resendotp, 20000);
        } else {
          $("#error").html(data);
          $(".loader-div").hide();
        }
      },
    });
  });

  // For resending otp message.
  $("#resendotp").on("click", function (e) {
    $("#resendotp").attr("disabled", "disabled");
    $(".loader-div").show();
    e.preventDefault();
    var email = $("#emailId").val();
    $.ajax({
      url: "/otpSend",
      type: "POST",
      data: {
        email: email,
      },
      success: function (data) {
        if (data == "OTP Send to your email address") {
          $("#error").html(data);
          $(".loader-div").hide();
          $("#resendotp").attr("disabled", true);
          time = setInterval(resendotp, 20000);
        } else {
          $("#error").html(data);
          $(".loader-div").hide();
        }
      },
    });
  });

  // For checking if user is online.
  $.ajax({
    url: "/onlineUser",
    success: function (data) {
      data.userOnline.forEach(function (user) {
        addOnlineUser(user);
      });
    },
  });

  // For adding online users.
  function addOnlineUser(user) {
    if (user.status == "0") {
      $("#onlinrup").append(
        '<div class="onlineuser"> <img src="' +
          user.img +
          '" class="image" /> <p>' +
          user.firstname +
          " " +
          user.lastname +
          '</p> <div class="dot"></div></div>'
      );
    } else {
      $("#onlinrdown").append(
        '<div class="onlineuser"> <img src="' +
          user.img +
          '" class="image" /> <p>' +
          user.firstname +
          " " +
          user.lastname +
          '</p> <div class="dot dOnline"></div></div>'
      );
    }
  }

  // For adding new posts
  function addpost(post) {
    var option = "";
    if (post.email != post.loginEmail) {
      option = "none";
    }
    $("#postpart").prepend(
      `
    <div class="post" id="post` +
        post.id +
        `"> 
    <div class="posttop">
    <h3>` +
        post.projectName +
        `</h3>
        <p class='teamname'> by ` +
        post.teamName +
        `
        </p>
    <div class="dropdown">
    <i class="fa fa-ellipsis-v" style="display:` +
        option +
        `"></i>
    <div class="dropdown-content">
    <button id="editPost` +
        post.id +
        ` " onclick="displayEditModal(` +
        post.id +
        `)">Edit</button>
    <button id="DeletePost` +
        post.id +
        `" onclick="DeletePost(` +
        post.id +
        `)">Delete</button>
    </div>
    </div>
    </div>

    
    <div id="myModal` +
        post.id +
        `" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
    <button class="close" id="close` +
        post.id +
        `" onclick="hideEditModal(` +
        post.id +
        `)">&times;</button>
    <input type="text" name="EditPost" value="` +
        post.title +
        `" id="confirmEditValue` +
        post.id +
        `" class="editText" required />
    <button class="confirm" id="confirm` +
        post.id +
        `" onclick="confirmEdit(` +
        post.id +
        `)">ConfirmEdit</button>
    </div>
    </div>


    <p id="postValue` +
        post.id +
        `">` +
        post.title +
        `<p>
    <div class="buttonldc">
    <div class="likeDislike">
    <button onclick="like(` +
        post.id +
        `)" id="likebutton` +
        post.id +
        `" class="likebut" ><i class="fa fa-thumbs-up" id="likeIcon` +
        post.id +
        `" ></i></button>
    <p id="likeText` +
        post.id +
        `">` +
        post.thumsUp +
        `</p>
    <button onclick="dislike(` +
        post.id +
        `)" class="likebut" id="dislikebutton` +
        post.id +
        `"><i class="fa fa-thumbs-down" id="dislikeIcon` +
        post.id +
        `" ></i></button>
    <p id="dislikeText` +
        post.id +
        `">` +
        post.thumsDown +
        `</p>
    </div>
    <a href= "` +
        post.projectDocuments +
        `" class="viewdocs" id="viewdocs` +
        post.id +
        `" target="_blank">View Documents</a>
    <button id="commentbut` +
        post.id +
        `" onclick="showComment(` +
        post.id +
        `)" > COMMENT</button>
    <button id="hide` +
        post.id +
        `" onclick="hideComment(` +
        post.id +
        `)" class="hide">Hide</button>
    </div>
    <div class="comments" id="comm` +
        post.id +
        `">
    <h3>Comments</h3>
    <div id="commentD` +
        post.id +
        `">
    </div>
    <input name="commentValue" id="commentValue` +
        post.id +
        `" placeholder="Add Some Comments" class="commentValue" />
    <button class="addcomment" id="addComment` +
        post.id +
        `" onclick="addComment(` +
        post.id +
        `)" >Comment</button>
    </div>
    </div>`
    );
  }

  // For showing all the posts
  $.ajax({
    url: "/post",
    success: function (data) {
      data.posts.forEach(function (post) {
        addpost(post);
        if (post.likeDislikeColor.length > 0) {
          $("#dislikeIcon" + post.id).css(
            "color",
            post.likeDislikeColor[0].dislikeColor
          );
          $("#likeIcon" + post.id).css(
            "color",
            post.likeDislikeColor[0].likeColor
          );
          if (post.likeDislikeColor[0].likeColor == "blue") {
            $("#dislikebutton" + post.id).attr("disabled", "disabled");
          } else if (post.likeDislikeColor[0].dislikeColor == "blue") {
            $("#likebutton" + post.id).attr("disabled", "disabled");
          }
        }
      });
    },
  });

  // For addind posts.
  $("#button").on("click", function (e) {
    e.preventDefault();
    var PostDetails = $("#postdescription").val();
    var project_name = $("#projectName").val();
    var team_name = $("#teamName").val();
    var PostDetails = PostDetails.replace(/<[^>]+>/gim, "");
    var file_data = $("#filePost").prop("files")[0];
    var form_data = new FormData();
    form_data.append("file", file_data);
    form_data.append("post", PostDetails);
    form_data.append("projectName", project_name);
    form_data.append("teamName", team_name);
    if (PostDetails != "") {
      $.ajax({
        url: "/post",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function (data) {
          l = data.posts.length;
          addpost(data.posts[l - 1]);
          $("#postdescription").val("");
          $("#filePost").val("");
          $("#projectName").val("");
          $("#teamName").val("");
        },
      });
    }
  });

  // For loading data.
  $.ajax({
    url: "/dataLoad",
    success: function (data) {
      data.dataArr.forEach(function (comments) {
        $("#middleleftbody").append(
          `<img src="` +
            comments.img +
            `" class="imgg" /> 
        <h2>` +
            comments.firstname +
            ` ` +
            comments.lastname +
            `</h2>
        <h3>` +
            comments.email +
            `</h3>
            <h3>` +
            comments.about +
            `</h3>`
        );
        $("#headimg").append(
          `<img src="` +
            comments.img +
            `" class="image" />
          <div class="dropdown-Logout">
            <button onclick="logout()">LogOut</button>
          </div>`
        );
        if (comments.role == "spoc") {
          $(".wiym").show();
        } else {
          $(".wiym").hide();
        }
      });
    },
  });

  // contact us
  $("#contactus").on("click", function (e) {
    $(".loader-div").show();
    e.preventDefault();
    var email = $("#email").val();
    var name = $("#name").val();
    var message = $("#message").val();
    $.ajax({
      url: "/contactussend",
      type: "POST",
      data: {
        email: email,
        name: name,
        message: message,
      },
      success: function (data) {
        $("#error").html(data);
        $(".loader-div").hide();
      },
    });
  });
});
