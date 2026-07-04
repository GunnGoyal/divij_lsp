# LSPlanner

LSPlanner is a web application developed for the La Salle community, where students can organize and manage their academic planning from a single platform.

Additionally, the application allows users to upload documents, manage tasks through a calendar and generate automatic summaries using an AI API.

## Prerequisites

To set up and run this web app, you'll need the following:

1. Web server (Nginx)
2. PHP 8
3. MySQL
4. Composer
5. Git

For this project, please use the provided Docker environment (as always, you can download it from eStudy).

## Requirements

1. Use CodeIgniter 4 as the underlying framework.
2. Use Composer to manage all the dependencies of your application.
3. Use Guzzle to make requests to the API.
4. Usage of CodeIgniter's Filters is required.
5. Usage of CodeIgniter's Validation is required to validate all forms and user inputs.
6. Usage of CodeIgniter's template engine with at least a base template and inheritance is required.
7. Implement CSS to style your application. Optionally, you may use a CSS framework. Keep CSS and JS organized and separated from the HTML templates.
8. Use MySQL as the main database management system.
9. Use the provided DB Migration files. Feel free to create new tables or modify the ones provided, but make sure to include the new migrations in the repository.
10. Effectively use Object-Oriented Programming principles, including Namespaces, Classes, and Interfaces.
11. Use Git to collaborate with your teammates.
12. Upload all the code to the private Git repository assigned to your team. 
13. Each team member must actively contribute to the project with at least 10 significant commits.
14. The web must be translated into 2 languages. You can choose the languages you want, but at least one of them must be English. The other language can be any other language you prefer.
15. The site must detect the user's language automatically and display the content in that language. If the language is not supported, it should default to English.
16. Your environment must be configured as Production when you deliver the project. This means that you must set the environment variable `CI_ENVIRONMENT` to `production` in your `.env` file.

### Use of AI assistants and tools - Disclosure

You are allowed to use AI assistants to search for information, ask questions, and to generate frontend code, but you shall not use AI to generate backend code, this will be penalized. You will need to disclose any AI usage, and if there are concerns about your code's authenticity, you may be asked to provide the source or inspiration for specific code sections.

That being said, we strongly encourage you to try and understand the concepts you're applying and figure out the reason behind any issues you encounter before blindly trying to get a LLM to solve a problem for you. In case of doubt, we recommend consulting a human instead of a machine.

## Resources

### MySQL

Use the provided DB Migration files to create the tables in the MySQL database. Feel free to create new tables or modify the ones provided, but make sure include the new migrations in the repository.

## Sections

The functionalities you must implement in this project can be divided into the following sections:

1. Landing Page
2. Sign Up
3. Sign In
4. Homepage
5. Subject Management
6. Task Management
7. AI Summaries
8. User Profile

The application must include a navigation system that allows users to easily access the different sections of the platform, including subjects, tasks, AI summaries, profile and logout.

### Landing Page

| Endpoints | Method |
|-----------| ------ |
| /         | GET    |

The Landing Page will display a welcome message along with a button to invite users to either Sign In or Register. It must show the amazing features of the application. The page should be visually appealing and responsive, ensuring a great user experience across all devices.

This page is only accessible to unregistered users, meaning that logged users should be redirected to `/home`.

### Sign-up

This section describes the process of signing up a new user into the system.

| Endpoints  | Method |
| ---------- | ------ |
| /sign-up   | GET    |
| /sign-up   | POST   |

When a user accesses the `/sign-up` endpoint, you need to display the registration form. The information from the form must be sent to the same endpoint using a **POST** method. The registration form should include the following inputs:

- Username - optional. If users do not provide a username, the system will use the email address as the username (without the domain).
- Profile picture - optional. If users do not provide a profile picture, the system will use a default image.
- Email - required.
- Password - required.
- Repeat password - required.

When a **POST** request is sent to the `/sign-up` endpoint, you must validate the information received from the form and sign up the user only if all the validations have passed. The requirements for each field are as follows:

- Email: It must be a valid email address (@students.salle.url.edu, @ext.salle.url.edu or @salle.url.edu). The email must be unique among all users of the application.
- Password: It must not be empty and must contain at least 8 characters, at least one number and both upper and lower case letters.
- Repeat password: It must be the same as the password field.

If there are any errors, you need to display the sign-up form again. All the information entered by the user should be kept and shown in the form (except for password fields) together with all the errors below the corresponding inputs.

Here are the error messages that you need to show respectively:

- Only emails from the domain @students.salle.url.edu, @ext.salle.url.edu or @salle.url.edu are accepted.
- The email address is not valid.
- The email address is already registered.
- The password must contain at least 8 characters.
- The password must contain both upper and lower case letters and numbers.
- Passwords do not match.

Once the user's account is created, the system will allow the user to sign in with the newly created credentials.

### Sign-in

This section describes the process of logging into the system.

| Endpoints  | Method |
| ---------- | ------ |
| /sign-in   | GET    |
| /sign-in   | POST   |

When a user accesses the `/sign-in` endpoint, you need to display the sign-in form. The information from the form must be sent to the same endpoint using a **POST** method. The sign-in form should include the following inputs:

- Email - required.
- Password - required.

When the application receives a **POST** request to the `/sign-in` endpoint, it must validate the information received from the form and attempt to log in the user. The validations for the inputs should be the same as in the registration.

If there are any errors or if the user does not exist, you need to display the form again with all the information provided by the user and display the corresponding error.

Here are the error messages that you need to show respectively:

- The email address is not valid.
- Your email and/or password are incorrect.

After logging in, the user will be redirected to the homepage.

### Homepage

| Endpoints | Method |
|-----------|--------|
| /home     | GET    |

The Homepage represents the main dashboard of the application.

Only authenticated users can access this page. If the user is not logged in, they must be redirected to `/sign-in` with an appropriate message.

The page must display an academic calendar with the tasks created by the user. The calendar should allow users to visualize their pending and completed tasks in a clear way.

Each task shown in the calendar must include:

- Title
- Related subject
- Deadline date
- Status

Users must be able to click on a task from the calendar to view its details.

From this page, users must also be able to:

- View their academic calendar
- Access task details
- Edit tasks
- Delete tasks
- Access the subject related to a task

### Subject Management

| Endpoints              | Method |
|------------------------|--------|
| /subjects              | GET    |
| /subjects/create       | GET    |
| /subjects/{id}         | GET    |
| /subjects/{id}/edit    | GET    |
| /subjects              | POST   |

This section describes how users can manage their subjects.

Only authenticated users can access these endpoints.

The `/subjects` page must display the list of subjects created by the user.

Each subject must include:

- Name
- Description
- Creation date

Users must be able to:

- Create subjects
- View subject details
- Edit subjects
- Delete subjects

When a user accesses `/subjects/{id}`, the application must display the subject details page.

Inside a subject, users must be able to:

- View the tasks related to the subject
- Create new tasks for the subject
- Upload PDF documents
- Write plain text notes or explanations
- View uploaded documents
- Generate AI summaries from uploaded documents
- View previously generated summaries

### Task Management

| Endpoints           | Method |
|---------------------|--------|
| /tasks              | GET    |
| /tasks/create       | GET    |
| /tasks/{id}         | GET    |
| /tasks/{id}/edit    | GET    |
| /tasks              | POST   |

This section describes how users can manage their academic tasks.

Only authenticated users can access these endpoints.

The `/tasks` page must display the list of tasks created by the user.

Each task must include:

- Title
- Description
- Deadline date
- Status
- Related subject

Users must be able to:

- Create tasks
- View task details
- Edit tasks
- Delete tasks
- Mark tasks as completed or pending

If a task is created outside a subject page, the user must select the related subject.

### AI Summaries

| Endpoints              | Method |
|------------------------|--------|
| /summaries             | GET    |
| /summaries/create      | GET    |
| /summaries/{id}        | GET    |
| /summaries             | POST   |

This section describes the AI functionalities of the application.

Only authenticated users can access these endpoints.

The `/summaries` page must display the summaries generated by the user.

Users must be able to:

- Generate summaries from uploaded PDF documents
- View generated summaries
- Delete summaries
- Generate summaries independently from any subject

Each summary must include:

- Title
- Generated summary
- Creation date
- Related subject (optional)

Users must be able to upload a PDF document and generate a summary using an AI API.

Since many AI APIs require paid plans for direct PDF processing, it is recommended to first extract the text content from the PDF and then send the extracted text to the AI API.

For example, libraries such as `smalot/pdfparser` may be used to extract the text before sending it to the AI service. However, the implementation details are left open and any alternative solution may be used.


### User Profile

| Endpoints | Method |
|-----------|--------|
| /profile  | GET    |
| /profile  | POST   |

This page allows users to view and manage their profile information.

Only authenticated users can access this endpoint. If the user is not logged in, they must be redirected to `/sign-in`.

The page must display:

- Username
- Email
- Profile picture

Users must be able to:

- Update their username
- Update their password
- Upload or change their profile picture
- Delete their account
- Log out

Password validations must be the same as in the registration process.

### Considerations

> **IMPORTANT:** The AI functionality must be implemented through your own backend. The frontend must not call the external AI API directly. Instead, it must send requests to your own backend endpoint, which will internally communicate with the external AI service using Guzzle.

> **IMPORTANT:** Since many AI APIs require paid plans for direct PDF processing, it is recommended to first extract the text content from the PDF and then send the extracted text to the AI API.

There are also additional considerations to take into account:

1. The endpoints described in the previous sections MUST be used exactly as specified. You cannot use alternative routes such as `/login` or `/register`.

2. You can use templates or UI frameworks to build the interface, but all backend logic must be implemented by you.

3. Only authenticated users can access protected routes such as `/home`, `/profile`, or any subject, task or summary-related functionality.

4. The AI feature must be integrated using an external API and should generate summaries from uploaded documents.

5. Clean code, proper structure, and readability will be taken into account during evaluation.

## Submission

You must submit this exercise in two different ways:

- **Git:** You will use Git and annotated tags to release new versions of your application. Tags should be pushed to the Gitlab repository to make them accessible to the instructors. Use **tag** `v1.0.0` for the final version.

- **eStudy:** For academic reasons, you must also upload a zipped copy of the final repository version on eStudy using the following filename format:  
  `lsplanner_<your_login>.zip`

Make sure that everything needed to properly run your application is included in the repository (including DB Migration files). Avoid committing unnecessary files (such as the contents of the `vendor` folder or user uploads), as they will remain in the repository history and increase its size.

> **IMPORTANT:** You must include an `INSTRUCTIONS.md` file with all the necessary information to run and use your application. This is especially important for features such as the AI integration or any additional functionality, as we need to understand your implementation decisions.

## Evaluation

1. Once the project is delivered, you will be interviewed by the teachers.
2. In this interview, we will validate that you understand the code you have written and the concepts behind it.
3. Check the syllabus of the subject for further information.

### Evaluation Criteria - `v1.0.0`

- Landing Page (Including semantic HTML and CSS of the whole project): 0.5p
- User Registration and Login: 1.5p
- Homepage (Calendar & task visualization): 1.5p
- Subject Management: 2p
- Task Management: 1.5p
- AI Summaries: 2p
- User Profile: 1p
- Other criteria (clean code quality, clean design, structure, etc.): -1.5p