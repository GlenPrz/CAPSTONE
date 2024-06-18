<!DOCTYPE html>
<html>
<head>
<title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	</head>
<body>
    <h1>Course Selection</h1>
    <form>
        <label for="subject">Select a subject:</label>
        <select id="subject" onchange="updateCourseLevels()">
            <option value="math">Math</option>
            <option value="science">Science</option>
            <option value="history">History</option>
        </select>
        <br><br>

        <label for="courseLevel">Select a course level:</label>
        <select id="courseLevel" onchange="updateSpecificCourses()">
            <!-- Options will be dynamically populated based on the selected subject -->
        </select>
        <br><br>

        <label for="specificCourse">Select a specific course:</label>
        <select id="specificCourse">
            <!-- Options will be dynamically populated based on the selected subject and course level -->
        </select>
        <br><br>
    </form>

    <script>
        // Define course data based on subject and course level
        const courseData = {
            math: {
                beginner: ['Algebra', 'Geometry'],
                intermediate: ['Calculus', 'Statistics'],
            },
            science: {
                beginner: ['Biology', 'Chemistry'],
                intermediate: ['Physics', 'Astronomy'],
            },
            history: {
                beginner: ['Ancient History', 'Medieval History'],
                intermediate: ['Modern History', 'World History'],
            },
        };

        // Function to populate course levels based on the selected subject
        function updateCourseLevels() {
            const subjectSelect = document.getElementById("subject");
            const courseLevelSelect = document.getElementById("courseLevel");
            const subject = subjectSelect.value;
            courseLevelSelect.innerHTML = "";
            for (const level in courseData[subject]) {
                const option = document.createElement("option");
                option.value = level;
                option.text = level;
                courseLevelSelect.appendChild(option);
            }
            updateSpecificCourses(); // Update the specific courses as well
        }

        // Function to populate specific courses based on the selected subject and course level
        function updateSpecificCourses() {
            const subjectSelect = document.getElementById("subject");
            const courseLevelSelect = document.getElementById("courseLevel");
            const specificCourseSelect = document.getElementById("specificCourse");
            const subject = subjectSelect.value;
            const level = courseLevelSelect.value;
            specificCourseSelect.innerHTML = "";
            for (const course of courseData[subject][level]) {
                const option = document.createElement("option");
                option.value = course;
                option.text = course;
                specificCourseSelect.appendChild(option);
            }
        }

        // Initial population of course levels
        updateCourseLevels();
    </script>
</body>
</html>
