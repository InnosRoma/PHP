// $.ajax({
//     dataType: "json",
//     url: "services.php",
//     data: {firstName: $(this), lastName: lastName, phone: phone, action: action, age: age},
//     success: function (data) {
//       var html ="";
//       for (var user_index = 0; user_index < data.length; user_index++) {
//         html += "<td>" + data[user_index].firstName + "</td>";
//         html += "<td>" + data[user_index].lastName + "</td>";
//         html += "<td>" + data[user_index].phone + "</td>";
//         html += "<td>" + data[user_index].active + "</td>";
//         html += "<td>" + data[user_index].age + "</td>";
//         html += "<td><a href=/"/">Edit</a> | <a href=/"/">Delete</a></td>"
//       }
//       $('table.users-table tbody').html(html);
//     }
//   });
// console.log($("td>a"));


$(document).on("click", "td a.delete", function(event) {
    event.preventDefault(); 
    var client_id = $(this).attr("data-id");
    var server_url = "http://localhost:81/PHP/services.php?q=user/delete&id=" + client_id;
    $(this).parents('tr').remove();
    console.log(client_id);
    $.ajax(server_url, function(){
        console.log( "Success" );
        }).done(function(){
    });
});

$(document).on("click", "td a.view", function(event) {
    //event.preventDefault();
    var client_id = $(this).attr("data-id");
    var server_url = "http://localhost:81/PHP/services.php?q=user/view&id=" + client_id;
    console.log(client_id);
    $.getJSON(server_url, function(){
        console.log( "Success" );
    }).done(function(data){
        if(data.active == 1 ){
            var status = "Active";
        } else status = "Non Active";
        console.log(data);
        var html ="";
        html+="<div align=\"center\" style=\"font-size:25px\">" + data.first_name + " " + data.last_name + "</div>";
        html+="<div align=\"left\" style=\"font-size:20px\">" + "Phone: " + data.phone + "</div>";
        html+="<div align=\"left\" style=\"font-size:20px\">" + "Age: " + data.age + "</div>";
        html+="<div align=\"left\" style=\"font-size:20px\">" + "Status: " + status + "</div>";
        html+="<div class=\"interests\">Interests:<ul type = \"disc\">";
        for(var i = 0; i < (data.interests.length); i++){
        html+='<li align="left" style="font-size:20px">' + data.interests[i].description + "</li>";
        }
        html+="</ul></div>";
        console.log(html);
        console.log($('div.content'));
        $('div.content').html(html);
        });
  });

  $(document).on("click", "td a.edit", function(event) {
    //event.preventDefault();
    var client_id = $(this).attr("data-id");
    var server_url = "http://localhost:81/PHP/services.php?q=user/view&id=" + client_id;
    console.log(client_id);
    $.getJSON(server_url, function(){
        console.log( "Success" );
    }).done(function(data){
        console.log(data);
        if(data.active == 1 ){
            var status = "Active";
        } else status = "Non Active";
        var html ="";
        html += "<div id=\"sc-edprofile\">";
        html += '<div alight="center" style="font-size:25px">Edit Profile Form</div>';
        html += '<form name="userEditForm" action="test.php" method="POST">';
        html += '<input type="text" size="10" name="first_name" value="' + data.first_name + '"/>'
        html += '<input type="text" name="last_name" value="' + data.last_name + '"/>'
        html += '<input type="number"  name="age" value="' + data.age + '"/>'
        html += '<input type="text" name="phone" value="' + data.phone + '"/>'
        html += "<textarea value=\"Add interest\" /></textarea>";
        html += "<button id=\"addButton\">Add</button>";
        html += `<select>
        <option value="" selected="selected" >` + status + `</option>
        <option value="1">Acive</option>
        <option value="2">Non Active</option>
      </select>`;
        html += "<div class=\"interests\">Interests:<ul type = \"disc\">";
        for(var i = 0; i < (data.interests.length); i++){
        html += '<li align="left" style="font-size:20px">' + data.interests[i].description + "</li>";
        }
        html += "</ul></div>";
        html += "<input type=\"submit\" value=\"Save\" />";
        html += "</form>";
        html += "</div>";
        console.log(html);  
        $('div.content').html(html);
        });
  });