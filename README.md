Event Media Manager

Description:
The Event Media Manager is a simple web application that allows users to upload, organize, and view media (such as images, videos, or documents) related to specific events. It was built with PHP and MySQL, focusing on clear structure, relational data handling, and user-friendly forms.

Key Features:

📂 Event Management: Create and manage events with titles and descriptions.

📸 Media Upload: Upload multiple types of media files (images, videos, etc.) tied to specific events.

🔗 Event–Media Relationship: Each media item is linked to an event, ensuring proper organization.

📑 Event Dropdown Selection: Users select events by their title (not ID) when uploading media, improving usability.

🖼️ Media Listing: View all uploaded media and their associated events.

⚡ Secure Uploads: Validates file types and stores files in a dedicated uploads directory with references in the database.

Database Structure:

events

id (Primary Key)

title (Event name)

description (Optional details about the event)

created_at (Timestamp of event creation)

media

id (Primary Key)

event_id (Foreign Key → events.id)

file_path (Server location of the uploaded file)

uploaded_at (Timestamp of upload)

Technologies: PHP, MySQL, HTML, CSS
