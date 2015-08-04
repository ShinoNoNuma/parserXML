function Getpath(path,id) {
  this.path = path;
  this.id = id;
}

Getpath.prototype.requestAjax = function() {
  $.ajax({
    type: "get",
    url: this.path,
    data: 'id_uploadxml=' + this.id, 
    dataType : "html",
    success: function(data, statut){

        $("#resultxml").empty().hide();
        $("#resultxml").append(data);
        $('#resultxml').fadeIn(2000);
        $('#msg').html('The xml file parsed !');

    },
    error : function(resultat, statut, erreur){
        alert('Your file upload is empty');
    },

});
  return false;
  
};


$('a').click(function() { 
    var paths = new Getpath($(this).data('path'),$(this).data('id'));
    paths.requestAjax(); 

});


$.get( "pages/getparsexml", function( data ) {
$( "#resultxml" ).html( data );
});