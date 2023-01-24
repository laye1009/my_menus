function showCart() {
    $.ajax({
        url: "/panier/voir",
        type: "POST",
        data: {'id':ids},
        success: function (data) {
            $('#voirpanier').html('');
            var html="<table><thead>\
                <tr><th>Liste de produits à commander</th></tr>\
                <tr><th class='ml:10'>Name</th><th class='text-center'>Description</th>\
                    <th style='margin-left:15px;'>Action</th></thead>";
                html+="<tbody>";
            //var output= data.substr(1,data.length-2);
            var output = JSON.parse(data);
            //console.log(output);
            //console.log(Array.from(data)[0]);
            //$('#voirpanier').html(data);
            for(var i=0;i<output.length;i++)
            {
                html+="<tr class='suppr'><td>"+output[i].name+"</td>";
                html+="<td>"+output[i].description+"</td>";
                html+="<td>\
                    <a style='margin-left:15px;' class='fa fa-trash'></a>\
                    </td></tr>";
            } 
            html+="</tbody></table>";
            //console.log(html);
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
                console.log($(this).parent());
                $(this).remove();
            });
        }
    });
}