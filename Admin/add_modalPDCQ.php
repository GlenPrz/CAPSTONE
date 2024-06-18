
<div id="addModalPDCQ" class="modal">
    <div class="modal-content">
        <h2>Add New Question</h2>
        <span class="close" onclick="closeAddModal()">&times;</span>
		 <div id="modalContent"></div>
        <form action="insert_question.php" method="post">
             
        <label for="qtitle">Title:</label>
            <input type="text" name="qtitle" required><br>

            <label for="desciption">Desciption:</label>
            <input type="text" name="desciption" required><br>
			
			<label for='Session_PDCQ'>Session:</label>
			<select name='Session_PDCQ'>"
			<option selected disabled >Select One</option>
			<option value='1'>1</option>
			<option value='2'>2</option>
			
			</select><br>
			
			<button type='button' class='cancel-button' onclick='closeAddModalPDCQ()'>Cancel</button>
            <button type='submit' class='proceed-button' name='proceedPDCQ' value='proceedPDCQ'>Add Question</button>

        </form>
    </div>
</div>

<script>
function addModalPDCQ() {
    document.getElementById("addModalPDCQ").style.display = "block";
}

function closeAddModalPDCQ() {
    document.getElementById("addModalPDCQ").style.display = "none";
}

window.onclick = function(event) {
    var modalPDCQ = document.getElementById('addModalPDCQ');
    if (event.target === modalPDCQ) {
        closeAddModal();
    }
};
</script>