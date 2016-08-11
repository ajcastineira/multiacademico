/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */
    "use strict";

    function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<td><a class="btn btn-danger btn-xs" href="#"><i class="fa fa-times"></i> Quitar Estudiante</a></td>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}
    function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
  

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    
    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<tr></tr>').append('<td>'+newForm+'</td>');
    $newFormLi.find('select').chosen();
    addTagFormDeleteLink($newFormLi);
    $newLinkLi.before($newFormLi);
    
    
    
}

    angular.module('multiacademico.comportamiento').directive('collectionForm', function ($state) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                
                

        var $collectionHolder;

// setup an "add a tag" link
var $addTagLink = $('<td><a class="btn btn-success btn-xs"  href="#" class="add_tag_link"><i class="fa fa-plus"></i>Agregar Estudiante</a></td>');
var $newLinkLi = $('<tr></tr>').append($addTagLink);


    // Get the ul that holds the collection of tags
    $collectionHolder = element;

    // add the "add a tag" anchor and li to the tags ul
   
    $collectionHolder.find('tbody tr').each(function() {
     addTagFormDeleteLink($(this));
    });
     $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
   

    $addTagLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
        
    });

                
            }
        }
    });




