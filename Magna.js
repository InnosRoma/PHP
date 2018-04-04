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