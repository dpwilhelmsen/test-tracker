<div class="modal hide" id="create_modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Add a New Test</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="{{ URL::to('photo/upload') }}" id="create_modal_form">
			<div class="formrow">
				<label for="txt_TestTitle" id="TestTitle-ariaLabel">Test Title</label>
				<input id="txt_TestTitle" name="txt_TestTitle" type="text" aria-labelledby="TestTitle-ariaLabel" />
			</div>
			<div class="formrow">
				<label for="txtarea_Description" id="Description-ariaLabel">Description</label>
				<textarea id="txtarea_Description" name="txtarea_Description" cols="20" rows="3" aria-labelledby="Description-ariaLabel"></textarea>
			</div>
			<div class="formrow">
				<label for="txt_Type" id="Type-ariaLabel">Type</label>
				<input id="txt_Type" name="txt_Type" type="text" aria-labelledby="Type-ariaLabel" />
			</div>
			<div class="formrow">
				<label for="txt_Section" id="Section-ariaLabel">Section</label>
				<input id="txt_Section" name="txt_Section" type="text" aria-labelledby="Section-ariaLabel" />
			</div>
			<div class="formrow">
				<label for="txt_Project" id="Project-ariaLabel">Project</label>
				<input id="txt_Project" name="txt_Project" type="text" aria-labelledby="Project-ariaLabel" />
			</div>
			<div class="formrow">
				<label for="txtarea_Conditions" id="Conditions-ariaLabel">Conditions</label>
				<textarea id="txtarea_Conditions" name="txtarea_Conditions" cols="20" rows="3" aria-labelledby="Conditions-ariaLabel"></textarea>
			</div>
			<div class="formrow">
				<label for="txtarea_Steps" id="Steps-ariaLabel">Steps</label>
				<textarea id="txtarea_Steps" name="txtarea_Steps" cols="20" rows="3" aria-labelledby="Steps-ariaLabel"></textarea>
			</div>
		</form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
        <button type="button" onclick="$('#create_modal_form').submit();" class="btn btn-primary">Create Test</a>
    </div>
</div>
