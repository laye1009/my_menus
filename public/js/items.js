<<<<<<< HEAD
$("#suppr").on("click",function(){console.log('ddd')});
=======
function showCart() {
    $.ajax({
        url: "/panier/voir",
        type: "GET",
        success: function (data) {
            $('#voirpanier').html('');
            var html="<table><thead>\
                <tr><th>Liste de produits à commander</th></tr>\
                <tr><th id='im'>Image</th><th class='mr:10'>Name</th><th class='text-center'>Description</th>\
                    <th style='margin-left:15px;'>Action</th></thead>";
                html+="<tbody>";
            //var output= data.substr(1,data.length-2);
            var output = JSON.parse(data);
            let vls = Object.values(output);
            console.log(Object.values(output)[0].description);
            for(var i = 0;i < vls.length; i++)
            {
                html+="<tr class='suppr'>";
                html += "<td>"+vls[i].image+"</td>";
                html += "<td>"+vls[i].name+"</td>";
                html+="<td>"+vls[i].description+"</td>";
                html+="<td>\
                    <a style='margin-left:15px;' class='fa fa-trash'></a>\
                    </td></tr>";
            } 
            html+="</tbody></table>";
            $('#voirpanier').append(html);

            $('#voirpanier').dialog({
                modal:true,
                width:600,
                height:300,
                buttons: {
                'Commander': function () {
                    alert('Votre commande est passée');
                    jQuery(this).dialog("close");
                }}
            });
            $(".suppr").on('click',function(){
                //console.log($(this).parent());
                console.log($("tbody").children().length);
                $(this).remove();
                if($('tbody').children().length === 0) {
                    //jQuery(this).dialog("close")
                    console.log('toto');
                }
            });
        }
    });
}
>>>>>>> 9bfb396 (reprise30042023)
