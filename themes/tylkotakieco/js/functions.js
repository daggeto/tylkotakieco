


function init()
{
        showFieldsFor($("#tekst"));
}

function randomizeImagesPositions(){
    
    
}

function agterLoad(){

}

var fields = {'tekst'  : ['typ', 'tytul', 'wiedza', 'zrodlo','submit'],
              'tekst_obrazek' : ['typ', 'tytul','obrazek' , 'wiedza', 'zrodlo','submit'],
              'obrazek' : ['typ', 'tytul','obrazek' , 'zrodlo','submit' ],
              'wideo' : ['typ', 'tytul','adres','submit']};

showFieldsFor($("input[name=type][value=tekst]"));

function showFieldsFor(source){
	var sourceType = $(source).val();
        $("form[name=dodaj] tr").each(function(){
             
             if(jQuery.inArray($(this).attr("name"), fields[sourceType]) > -1){
                 $(this).show();
             }else{
                 $(this).hide();
             }
        });

        selectType(source);
}

function selectType(source){

    $("#typeDiv li").removeClass('selectedType');
    $("label[for=" + $(source).attr("id") + "]").parent().addClass('selectedType');

}

