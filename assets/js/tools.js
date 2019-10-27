jQuery(document).ready(function()
{
	$('select.js-todo-order').change(changeTodoOrder);
	$('.js-finish').click(finishTask);
	$('.js-edit-task').submit(editTask);
	$('.js-edit').click(editModalForm);
});

function editModalForm()
{
	$('.js-edit-task input[name="id"]').val($(this).attr('data-id'));
	$('.js-edit-task [type="submit"]').prop('disabled', 'disabled');
	var params = {
		'id': $(this).attr('data-id'),
	}
	$.post('todo/getText', params, function(res){
		$('.js-edit-task [type="submit"]').prop('disabled', false);
		$('.js-edit-task textarea[name="text"]').html(res.text);
	}, 'JSON');
}

function editTask(e) {
	e.preventDefault();
	$.post('todo/editText', $(this).serialize(), function(res){
		if (res.error)
		{
			alert(res.error);
			$('#editTaskModal').modal('hide')
		}
		window.location.reload();
	}, 'JSON');

}

function finishTask(e)
{
	e.preventDefault();
	var params = {
		'id': $(this).attr('data-id'),
	}
	$.post('todo/finish', params, function(res){
		if (res.error)
			alert(res.error)
		else
			window.location.reload();
	}, 'JSON');
}

function changeTodoOrder()
{
	var params = {
		'field': $(this).find('option:selected').val(),
	}
	$.post('todo/changeOrder', params, function(){
		window.location.reload();
	}, 'JSON');
}