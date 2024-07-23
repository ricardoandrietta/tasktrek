# Project and Task Management API with Burndown Chart

## Description

Develop a RESTful API that allows developers to manage tasks within projects. The API includes CRUD operations for projects and tasks, prioritization of tasks, time estimation, and marking tasks as done or in progress. Additionally, a UI will display a burndown chart.

## Technologies

- **Backend**: PHP
- **Architecture**: Clean Architecture
- **Documentation**: Swagger/OpenAPI
- **Frontend**: Optional (for burndown chart)

## Features

1. **User Authentication and Authorization**
    - Register a new user
    - Login user and generate JWT
    - Middleware to protect endpoints

2. **Project Management**
    - Create a new project
    - Retrieve projects (single and list)
    - Update a project
    - Delete a project

3. **Task Management within Projects**
    - Create a new task within a project
    - Retrieve tasks (single and list) within a project
    - Update a task within a project
    - Delete a task within a project
    - Prioritize tasks
    - Estimate time for tasks (multiple of 0.25 days)
    - Mark tasks as done or in progress

4. **Burndown Chart**
    - Generate and display a burndown chart for a project
