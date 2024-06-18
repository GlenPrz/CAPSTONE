
<div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Add New Question</h2>
        <span class="close" onclick="closeAddModal()">&times;</span>
		 <div id="modalContent"></div>
       <form action="insert_question.php" method="post" enctype="multipart/form-data">

            <label for="question">Question:</label>
            <input type="text" name="question" required><br>
        
            <!-- Add image input -->
            <label for="ques_img">Upload Image:</label>
            <input type="file" name="ques_img"><br>
        
            <label for="ans1">Answer 1:</label>
            <input type="text" name="ans1" required><br>
        
            <label for="ans2">Answer 2:</label>
            <input type="text" name="ans2" required><br>
        
            <label for="ans3">Answer 3:</label>
            <input type="text" name="ans3" required><br>
        
            <label for="ans4">Answer 4:</label>
            <input type="text" name="ans4" required><br>
        
            <label for='correct_answer'>Correct Answer:</label>
            <select name='correct_answer'>
                <option selected disabled>Select One</option>
                <option value='A'>A</option>
                <option value='B'>B</option>
                <option value='C'>C</option>
                <option value='D'>D</option>
            </select><br>
        
            <label for='topic'>Module:</label>
            <select name='topic'>
                <option selected disabled>Select One</option>
                <option value='Module 1'>Module 1</option>
                <option value='Module 2'>Module 2</option>
                <option value='Module 3'>Module 3</option>
            </select><br>
        
            <button type='button' class='cancel-button' onclick='closeAddModal()'>Cancel</button>
            <button type='submit' class='proceed-button' name='proceed'>Add Question</button>
        </form>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById("addModal").style.display = "block";
}

function closeAddModal() {
    document.getElementById("addModal").style.display = "none";
}

window.onclick = function(event) {
    var modal = document.getElementById('addModal');
    if (event.target === modal) {
        closeAddModal();
    }
};
</script>