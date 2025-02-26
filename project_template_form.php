<form>
    <div class="grid-container">
        <div class="form-input">
            <input type="text" id="project_name" name="project_name" placeholder="Project Name" required />
            <label for="project_name">Project Name</label>
        </div>
        <div class="form-input">
            <input type="text" id="project_assignee" name="project_assignee" placeholder="Project Assignee" required />
            <label for="project_assignee">Project Assignee</label>
        </div>
        <div class="form-input">
            <input type="number" id="project_due" name="project_due" placeholder="Project Due" required />
            <label for="project_due">Due</label>
        </div>
        <div class="custom-select">

            <select name="project_recurrence" id="">
                <option value="none">None</option>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>
        </div>
        <div class="tag-container form-input-skill" name="Skill">
            <div class="form-input">
                <input type="text" class="tag-input" id="tag-input" placeholder="Add tags" onkeydown="addTag(event)">
                <label for="Skill">Project Tags</label>

            </div>
            <div class="tags" id="tag-list">
            </div>
            <input type="hidden" name="tags" id="hidden-tags">
        </div>
        <h4 style="margin-bottom: 1rem;">Project Details</h4>
        <div class="form-input-des item6" style="margin-bottom: 20px;">
            <input type="hidden" name="texteditor" id="texteditor-hidden">
            <div class="wsyig" id="wsyig"></div>
        </div>

        <div class="task-form-header">
            <h3>Tasks</h3>
            <div>
                <button type="button">Collaps All</button>
                <button type="button">Expand All</button>
            </div>
        </div>

        <div id="task-display-container">
            <div id="task-list">
                <!-- <div class="task-item">
                    <div class="initial-task-info">
                        <h4 class="task-title-h none-mb">Create API</h4>
                        <h4 class="task-due-h none-mb">5 days from creation</h4>
                    </div>
                    <div class="detailed-task-info">
                        <ul>
                            <li><strong>Task Name:</strong> Create API</li>
                            <li><strong>Task Assignee:</strong> Ronak Jah</li>
                            <li><strong>Due:</strong> 3</li>
                            <li><strong>Tags:</strong> API, Python</li>
                            <li><strong>Details:</strong> This is the task details</li>
                        </ul>
                    </div>

                </div> -->
            </div>
            <div class="add-task-btn-container">
                <button type="button" class="add-another-task-btn" id="add-another-task-btn">Add another task</button>
            </div>
        </div>

    </div>
    <div class="task-form-container" id="task-form-container">
        <div class="form-input">
            <input type="text" id="task_name" name="task_name" placeholder="Task Name" required />
            <label for="task_name">Task Name</label>
        </div>
        <div class="form-input">
            <input type="text" id="task_assignee" name="task_assignee" placeholder="Task Assignee" required />
            <label for="task_assignee">Task Assignee</label>
        </div>
        <div class="form-input">
            <input type="number" id="task_due" name="task_due" placeholder="Task Due" required />
            <label for="task_due">Task Due</label>
        </div>
        <div class="tag-container form-input-skill" name="Skill">
            <div class="form-input">
                <input type="text" class="tag-input" id="task-tag-input" placeholder="Add tags"
                    onkeydown="addTaskTag(event)">
                <label for="Skill">Task Tags</label>
            </div>
            <div class="tags" id="task-tag-list">
            </div>

            <input type="hidden" name="task-tags" id="hidden-task-tags">
        </div>
        <h4>Task Details</h4>
        <div class="form-input-des">
            <input type="hidden" name="texteditorTask" id="texteditor-hidden-Task">
            <div class="wsyigTask" id="wsyigTask"></div>
        </div>
        <div class="btn-container-popup">
            <button type="button" class="save-btn-0po90" id="taskSaveBtn">Save</button>
        </div>
        <input type="hidden" name="project-tasks-list" id="project-tasks-list">
    </div>


    <div class="btn-container-popup">
        <button type="button" class="save-btn-0po90" id="save-template-btn">Save</button>
        <button type="button" class="cancle-btn-0po90" onclick="closePopup()">Cancel</button>

    </div>

</form>