if(typeof jQuery == 'undefined'){
    alert("jquery hasn't loaded");
}
function addItemEvents(i,elm){
    $("input[type='checkbox']",elm).change(markDone);
    $(elm).dblclick(editText);
}
function markDone(e){
    var item = $(this).parent();
    var mark = 'done';
    if(this.checked){
        $("span",item).addClass('done');
    } else {
        mark = 'undone';
        $("span",item).removeClass('done');
    }
    $.post('action.php', {'mark': mark, 'item': item.attr('task') });
}
function editText(e){
    var item = $("span",getFirst(e, "li"));
    var newText = prompt("New Text:",item.text());
    if(newText != null){
        item.html(newText.replace(/(#[^\W]+)/g,'<em>$1</em>'));
        $.post('action.php', {'update': newText, 'item': item.parent().attr('task') });
    }
}
function setUpNewItemLinks(e){
    var newItem = prompt("New Item:");
    var link = $(e.target);
    if(newItem != null){
        var taggedItem = newItem.replace(/(#[^\W]+)/g,'<em>$1</em>');
        $('<li task="temp"><input type="checkbox"> <span>'+taggedItem+'</span></li>').appendTo("ul[list='"+link.attr('list')+"']");
        $.post('action.php', { "insert": newItem, "list": link.attr('list') }, 
        function(data){
            var temp = $("li[task='temp']");
            addItemEvents(0,temp);
            temp.attr('task',data);
        });
    }
    return false;
}
function setUpEditListTitle(e){
    var clone = $(this).clone();
    $("span", clone).remove();
    var newText = prompt("New Title Text:", $.trim(clone.text()));
    if(newText != null){
        $(this).text(newText);
        $.post('action.php', {"update": newText, "list":$(this).attr('list') });
    }
    return false;
}
function setUpArchiveList(e){
    var sure = confirm('Are you sure you want to archive this list and all its items?');
    if(sure){
        var list = $(this).parent().attr('list');
        $.post('action.php', { "archive": list });
        $("[list='"+list+"']").hide();
    }
    return false;
}
function setUpNewList(){
    var title = prompt("New List Title:");
    if(title != null){
        window.location = './action.php?new='+escape(title);
    }
    return false;
}
function getFirst(e, node){
    var elm = $(e.target);  
    while(!elm.is(node)){
        elm = elm.parent();
    }
    return elm;
}
$(document).ready(function(){
    $("li").each(addItemEvents);
    $("a.newitem").click(setUpNewItemLinks);
    $("h1").dblclick(setUpEditListTitle);
    $("a.newlist").click(setUpNewList);
    $(".archive").click(setUpArchiveList);
})