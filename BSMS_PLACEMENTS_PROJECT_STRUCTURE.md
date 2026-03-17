# BSMS Placements Platform - Complete Project Structure

**Platform Purpose:** Brighton & Sussex Medical School (BSMS) student placement management and medical education content delivery system

**Current Tech Stack:** Laravel 9.19 + PHP 8.0.2 + Vue.js 3.4.31 + Inertia.js + Laravel Nova 4.34.3

**Last Updated:** December 16, 2025

---

## Table of Contents
1. [Project Overview](#project-overview)
2. [Technology Stack](#technology-stack)
3. [Authentication & Authorization](#authentication--authorization)
4. [Data Models](#data-models)
5. [Core Functionality](#core-functionality)
6. [API Endpoints](#api-endpoints)
7. [Admin Interface (Nova)](#admin-interface-nova)
8. [File Structure](#file-structure)
9. [Third-Party Integrations](#third-party-integrations)
10. [Database Schema](#database-schema)
11. [Frontend Components](#frontend-components)

---

## Project Overview

The BSMS Placements platform serves multiple purposes:
- **Student Placement Management** - Track medical student placements at GP practices and hospitals
- **Educational Content Delivery** - Anatomy videos, dissections, medical imaging (DICOM), 3D models
- **Assessment Tools** - Physquiz modules, spotters, biomedical engineering content
- **Note-taking System** - Session notes with categories and modules
- **Pathology Resources** - PathPots database with categorized content
- **User Management** - Students, facilitators, GP teachers, administrators

---

## Technology Stack

### Backend Framework
- **Laravel:** 9.19
- **PHP:** 8.0.2+
- **Database:** MySQL

### Frontend
- **Vue.js:** 3.4.31
- **Inertia.js:** 0.11.1 (bridging Laravel & Vue)
- **Vite:** 5.3.2 (build tool)
- **TailwindCSS:** 3.4.4
- **Vuex:** 4.1.0 (state management)

### Admin Panel
- **Laravel Nova:** 4.34.3 (staff-only admin interface)

### Key PHP Dependencies
```json
{
  "laravel/framework": "^9.19",
  "laravel/nova": "~4.34.3",
  "laravel/sanctum": "^3.0",
  "laravel/ui": "^4.2.0",
  "directorytree/ldaprecord-laravel": "^2.6",
  "uabookstores/laravel-shibboleth": "^3.4",
  "codegreencreative/laravel-samlidp": "5.2.11",
  "barryvdh/laravel-dompdf": "^2.0",
  "maatwebsite/excel": "^3.1",
  "livewire/livewire": "^2.11"
}
```

### Frontend Dependencies
```json
{
  "vue": "^3.4.31",
  "vuex": "^4.1.0",
  "@inertiajs/inertia": "^0.11.1",
  "@inertiajs/inertia-vue3": "^0.6.0",
  "dwv": "^0.32.6",
  "tailwindcss": "^3.4.4"
}
```

---

## Authentication & Authorization

### Authentication Methods
The platform supports **three authentication methods**:

1. **Shibboleth SSO** (`uabookstores/laravel-shibboleth`)
   - University single sign-on integration
   - Primary authentication for students and staff

2. **SAML 2.0 IdP** (`codegreencreative/laravel-samlidp`)
   - SAML identity provider capabilities
   - For external system integrations

3. **LDAP Integration** (`directorytree/ldaprecord-laravel`)
   - Active Directory authentication
   - User attribute synchronization (guid, domain)

4. **Laravel Sanctum** (API authentication)
   - Token-based API authentication for mobile/external apps
   - Personal access tokens

### Authorization Model

#### Role-Based Access Control
- **User Model:** `belongsTo` Role
- **Role Model:** `hasMany` Users
- Each user has a `role_id` foreign key

#### Helper Methods (User Model)
```php
public function hasRole($roleName)
{
    return optional($this->role)->name === $roleName;
}

public function hasAnyRole(array $roles)
{
    return in_array(optional($this->role)->name, $roles);
}
```

#### Nova Access Control
- Configured via `.env`: `NOVA_ACCESS_ROLES`
- Only users with specified roles can access Nova admin panel
- Common roles: admin, supervisor, facilitator
- Authorization checks in Nova resources using `$request->user()->hasRole()`

---

## Data Models

### Core Models

#### 1. User
**File:** `app/Models/User.php`
**Purpose:** Primary user model for students, staff, administrators

**Key Fields:**
```php
[
  'name', 'email', 'password', 'role', 'active', 'known_as',
  'dob', 'gender', 'guid', 'domain', 'avatar', 'role_id',
  'student_number', 'year', 'rotation_group', 'workshop_group',
  'car_owner', 'gp_teacher', 'facilitator_id', 'locations_id',
  'first_name', 'username', 'category_id', 'user_id'
]
```

**Relationships:**
- `belongsTo(Role::class)` - User role
- `hasMany(Placement::class)` - Student placements
- `belongsToMany(Notes::class)` - Session notes

**Traits:**
- `HasApiTokens` (Sanctum)
- `Notifiable`
- `HasFactory`
- `Actionable` (Nova)
- `CanResetPassword`

#### 2. Student
**File:** `app/Models/Student.php`
**Purpose:** Legacy student-specific model (may overlap with User)

**Key Fields:**
```php
[
  'id', 'name', 'bsms_id', 'student_number', 'firstname',
  'known_as', 'dob', 'age', 'email', 'rotation_group', 'year',
  'gp_teacher', 'locations', 'guid', 'domain'
]
```

**Relationships:**
- `belongsTo(GPTeacher::class)` - GP supervisor
- `belongsTo(Location::class)` - Placement location
- `hasMany(Placement::class)` - Placements

**Methods:**
- `getAge()` - Calculate age from DOB

#### 3. Placement
**File:** `app/Models/Placement.php`
**Purpose:** Track student clinical placements

**Key Fields:**
```php
['name', 'surgery', 'id', 'student_id', 'created_at']
```

**Relationships:**
- `belongsTo(User::class)` - Student
- `belongsToMany(Tag::class)` - Tags

#### 4. Notes
**File:** `app/Models/Notes.php`
**Purpose:** Session notes, teaching materials

**Key Fields:**
```php
[
  'id', 'name', 'administrator', 'urlCode', 'email',
  'video', 'category_id', 'module_101_id', 'module_102_id',
  'created_at'
]
```

**Relationships:**
- `belongsTo(User::class, 'administrator')` - Creator
- `belongsTo(User::class, 'email')` - Associated user
- `belongsTo(Category::class)` - Category
- `belongsTo(Module101::class)` - Module 101
- `belongsTo(Module102::class)` - Module 102

#### 5. PathPots
**File:** `app/Models/PathPots.php`
**Purpose:** Pathology pot database with specimens/cases

**Key Fields:**
```php
[
  'id', 'name', 'administrator', 'urlCode', 'email',
  'course', 'category_id', 'created_at', 'updated_at'
]
```

**Relationships:**
- `belongsTo(User::class, 'email')`
- `belongsTo(Category::class)`

**Features:**
- Scout searchable (Laravel Scout integration)

#### 6. Dissection (Videos)
**File:** `app/Models/Dissection.php`
**Purpose:** Anatomy dissection videos

**Key Fields:**
```php
['id', 'name', 'video', 'category_id', 'created_at']
```

**Relationships:**
- `belongsTo(Category::class)`
- `belongsTo(User::class, 'email')`

#### 7. Physquiz
**File:** `app/Models/Physquiz.php`
**Purpose:** 3D models and physiology quiz content

**Key Fields:**
```php
[
  'id', 'name', 'urlCode', 'url', 'content_type',
  'file_path', 'created_at'
]
```

**Content Types:**
- URL-based models
- File uploads
- Mixed content

**API Response:**
```php
Physquiz::select('id', 'name', 'urlCode')->get()
```

#### 8. Dicom
**File:** `app/Models/Dicom.php`
**Purpose:** Medical imaging (DICOM format) files

**Key Fields:**
```php
['id', 'name', 'filename', 'study_id', 'series_id', 'created_at']
```

**Integration:**
- DWV (DICOM Web Viewer) JavaScript library
- CORS-enabled API endpoints

#### 9. Spotters
**File:** `app/Models/Spotters.php`
**Purpose:** Anatomy spotter questions/images

**Key Fields:**
```php
['id', 'name', 'image', 'answer', 'category_id', 'created_at']
```

#### 10. Category
**File:** `app/Models/Category.php`
**Purpose:** Content categorization system

**Key Fields:**
```php
['id', 'name', 'slug', 'description']
```

**Used By:**
- Notes
- PathPots
- Dissections
- Spotters
- Biomedeng

#### 11. GPTeacher
**File:** `app/Models/GPTeacher.php`
**Purpose:** GP (General Practice) supervisors/teachers

**Key Fields:**
```php
['id', 'name', 'email', 'practice_name', 'location_id']
```

**Relationships:**
- `belongsTo(Location::class)`
- `hasMany(User::class)` - Students assigned

#### 12. Facilitator
**File:** `app/Models/Facilitator.php`
**Purpose:** Clinical placement facilitators

**Key Fields:**
```php
['id', 'name', 'email', 'specialty', 'location_id']
```

#### 13. Location
**File:** `app/Models/Location.php`
**Purpose:** Clinical placement locations (hospitals, GP practices)

**Key Fields:**
```php
['id', 'name', 'address', 'type', 'capacity']
```

#### 14. Workshops
**File:** `app/Models/Workshops.php`
**Purpose:** Workshop sessions/events

**Key Fields:**
```php
['id', 'name', 'date', 'location', 'facilitator_id']
```

#### 15. IAP (Individual Action Plan)
**File:** `app/Models/IAP.php`
**Purpose:** Student individual action plans

#### 16. Group
**File:** `app/Models/Group.php`
**Purpose:** Student cohort groups

#### 17. Rooms
**File:** `app/Models/Rooms.php`
**Purpose:** Teaching room allocations

#### 18. Biomedeng
**File:** `app/Models/Biomedeng.php`
**Purpose:** Biomedical engineering content

**Key Fields:**
```php
['id', 'name', 'urlCode', 'category_id']
```

#### 19. Module101 / Module102
**Files:** `app/Models/Module101.php`, `app/Models/Module102.php`
**Purpose:** Course module organization (Year 1, Year 2)

#### 20. Anatomy / AnatomyVideos
**Files:** `app/Models/Anatomy.php`, `app/Models/AnatomyVideos.php`
**Purpose:** Anatomy-specific content organization

#### 21. Nifti
**File:** `app/Models/Nifti.php`
**Purpose:** NIfTI format neuroimaging files

#### 22. Role / Role2
**Files:** `app/Models/Role.php`, `app/Models/Role2.php`
**Purpose:** User role definitions

#### 23. Directory
**File:** `app/Models/Directory.php`
**Purpose:** Staff/student directory

#### 24. Invitation
**File:** `app/Models/Invitation.php`
**Purpose:** User invitation system

#### 25. NoteView
**File:** `app/Models/NoteView.php`
**Purpose:** Track note viewing analytics

#### 26. Video
**File:** `app/Models/Video.php`
**Purpose:** General video content

**Key Fields:**
```php
['id', 'name', 'video']
```

---

## Core Functionality

### 1. Placement Management
- Students can log placements with surgery/clinical location
- Track placement dates and types
- Associate placements with GP teachers and locations
- View placement history

### 2. Educational Content Delivery

#### Anatomy & Dissection
- Video library of dissections
- Categorized by body system/region
- Associated with course modules (101/102)

#### Medical Imaging
- **DICOM Viewer:** Browser-based DICOM image viewer
- **NIfTI Viewer:** Neuroimaging file viewer
- Study and series organization

#### 3D Models & Physquiz
- Interactive 3D anatomical models
- Embedded via URL codes
- File upload support
- Mixed content types

#### Spotters
- Image-based anatomy questions
- Answer key system
- Categorized by topic

#### PathPots
- Pathology specimen database
- Searchable with Laravel Scout
- Course/category organization

### 3. Note-Taking System
- Session notes linked to users
- Video integration
- Module association (101/102)
- Category organization
- View tracking (NoteView model)

### 4. User Management
- Student registration and profiles
- Role-based permissions
- GP teacher assignments
- Facilitator assignments
- Location assignments
- Workshop group assignments
- Rotation group tracking

### 5. Workshop Management
- Workshop scheduling
- Location assignment
- Facilitator assignment
- Student attendance tracking

### 6. PDF Generation
- PDF export functionality (dompdf)
- Document generation from content

### 7. File Management
- Avatar uploads
- Video uploads
- PDF storage
- DICOM file storage
- NIfTI file storage

---

## API Endpoints

### Authentication
```
POST   /api/login                    - Sanctum token authentication
POST   /api/register                 - User registration
POST   /api/logout                   - Revoke token
GET    /api/user                     - Get authenticated user
```

**Login Response:**
```json
{
  "token": "...",
  "user": {
    "id": 1,
    "name": "...",
    "email": "...",
    "username": "...",
    "student_number": "...",
    "year": 1,
    "rotation_group": "A",
    "workshop_group": 1,
    ...
  }
}
```

### Data Retrieval
```
GET    /api/placements               - All placements
POST   /api/placements               - Create placement
GET    /api/Student                  - All students
GET    /api/User                     - All users
GET    /api/Notes                    - All notes
GET    /api/PathPots                 - All path pots
GET    /api/Dissection               - All dissections
GET    /api/Workshops                - All workshops
GET    /api/GPTeachers               - All GP teachers
GET    /api/Location                 - All locations
GET    /api/dicom                    - All DICOM studies
GET    /api/biomedengs               - All biomedeng content
GET    /api/spotters                 - All spotters
GET    /api/physquiz                 - All physquiz items
GET    /api/3d-models                - 3D models (id, name, urlCode)
GET    /api/categories               - All categories
```

### Resource CRUD
```
GET    /api/notes                    - Index
POST   /api/notes                    - Store
GET    /api/notes/{id}               - Show
PUT    /api/notes/{id}               - Update
DELETE /api/notes/{id}               - Destroy

GET    /api/dissections              - Index
POST   /api/dissections              - Store
GET    /api/dissections/{id}         - Show
PUT    /api/dissections/{id}         - Update
DELETE /api/dissections/{id}         - Destroy

GET    /api/users                    - Index
POST   /api/users                    - Store
GET    /api/users/{id}               - Show
PUT    /api/users/{id}               - Update
DELETE /api/users/{id}               - Destroy

GET    /api/dicom                    - Index (CORS-enabled)
POST   /api/dicom                    - Store (CORS-enabled)
```

### Password Reset
```
POST   /api/forgot-password          - Send reset link
GET    /api/reset-password           - Show reset form
```

### File Uploads
```
POST   /api/upload-content-with-package - Video upload with metadata
```

---

## Admin Interface (Nova)

### Nova Resources
Nova provides staff-only admin interface for:

1. **User Management**
   - Users
   - Students
   - Roles

2. **Placement Management**
   - Placements
   - Locations
   - GPTeachers
   - Facilitators
   - Groups

3. **Content Management**
   - Notes
   - PathPots
   - Dissections (Videos)
   - Physquiz
   - Spotters
   - Biomedeng
   - Anatomy
   - AnatomyVideos
   - Videos

4. **Medical Imaging**
   - Dicom
   - Nifti

5. **Course Organization**
   - Categories
   - Module101
   - Module102

6. **Other**
   - Workshops
   - IAP
   - Rooms
   - Directory
   - Invitations

### Nova Actions
Custom actions available in Nova:

1. **ActivateUser** - Activate user accounts
2. **Enrolled** - Mark students as enrolled
3. **Import** - Bulk import users/data
4. **ResetPassword** - Admin password reset
5. **SendPasswordResetLink** - Email reset links
6. **ShowPathPots** - Display PathPot viewer
7. **UserResetPassword** - User-initiated reset

### Nova Metrics/Cards
Dashboard metrics:

1. **AdminAccessGuide** - Access documentation
2. **AdminDocsDisplay** - Documentation display
3. **DicomStudies** - DICOM study count
4. **Dissections** - Dissection video count
5. **Dissectionvideos** - Video metrics
6. **FacilitatorCount** - Active facilitators
7. **GPCount** - GP teacher count
8. **NewUsers** - Recent user registrations
9. **NotesCount** - Total notes
10. **PathPotsCount** - PathPot count
11. **PhysQuizzesCount** - Physquiz count
12. **SessionNotes** - Session note metrics
13. **StudentCount** - Active students
14. **Surgeries** - Placement surgeries
15. **VideoCount** - Total videos
16. **placementAcivity** - Placement analytics
17. **results** - General results metrics

### Nova Lenses
Filtered views:

1. **Course101** - Module 101 content
2. **CourseCategory** - Category-filtered content

### Nova Filters
- **CategoryFilter** - Filter by category

### Nova Custom Resources
- **FilteredNoteResource** - Filtered note view
- **FilteredPotResource** - Filtered PathPot view
- **NoteInsight** - Note analytics

### Nova Dashboards
1. **Main** - Primary dashboard
2. **AnatomyInterface** - Anatomy-specific dashboard

### Access Control in Nova
All Nova resources implement authorization:

```php
public static function authorizedToViewAny(Request $request)
{
    return $request->user()->hasAnyRole(['admin', 'supervisor']);
}

public function authorizedToUpdate(Request $request)
{
    return $request->user()->hasRole('admin');
}
```

---

## File Structure

```
placements.bsms.ac.uk/
├── app/
│   ├── Console/              # Artisan commands
│   ├── Enum/                 # Enumerations (StatusEnums, UserLevel)
│   ├── Events/               # Laravel events
│   ├── Exceptions/           # Exception handlers
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── API/          # API controllers
│   │   │   ├── Auth/         # Authentication controllers
│   │   │   ├── DicomController.php
│   │   │   ├── NotesController.php
│   │   │   ├── PathPotController.php
│   │   │   ├── PhysquizController.php
│   │   │   ├── SpottersController.php
│   │   │   ├── UserController.php
│   │   │   ├── VideoController.php
│   │   │   └── ...
│   │   ├── Middleware/       # Custom middleware (CORS, etc.)
│   │   └── Requests/         # Form requests
│   ├── Imports/              # Excel import classes
│   ├── Ldap/                 # LDAP integration
│   ├── Listeners/            # Event listeners
│   ├── Mail/                 # Mailable classes
│   ├── Models/               # Eloquent models (32 models)
│   ├── Notifications/        # Notification classes
│   ├── Nova/                 # Nova resources (62 files)
│   │   ├── Actions/          # Nova actions
│   │   ├── Cards/            # Nova dashboard cards
│   │   ├── Dashboards/       # Nova dashboards
│   │   ├── Filters/          # Nova filters
│   │   ├── Lenses/           # Nova lenses
│   │   ├── Metrics/          # Nova metrics
│   │   └── [Resources].php   # Nova resources
│   ├── Observers/            # Model observers
│   ├── Policies/             # Authorization policies
│   ├── Providers/            # Service providers
│   ├── Traits/               # Reusable traits
│   └── View/                 # View composers
├── bootstrap/                # Framework bootstrap
├── config/                   # Configuration files (28 files)
│   ├── auth.php
│   ├── database.php
│   ├── ldap.php
│   ├── nova.php
│   ├── sanctum.php
│   ├── shibboleth.php
│   └── ...
├── database/
│   ├── factories/            # Model factories
│   ├── migrations/           # Database migrations (73 files)
│   └── seeders/              # Database seeders
├── lang/                     # Localization files
├── nova-components/          # Custom Nova components (16 items)
│   └── MostViewedNotes/      # Custom Nova card
├── public/                   # Public web root
│   ├── avatars/              # User avatars
│   ├── pdf/                  # PDF files
│   ├── videos/               # Video files
│   ├── dicom/                # DICOM files
│   └── ...
├── resources/
│   ├── css/                  # Stylesheets
│   ├── js/                   # JavaScript/Vue components
│   │   ├── app.js
│   │   ├── bootstrap.js
│   │   └── components/       # Vue components
│   ├── lang/                 # Language files
│   ├── sass/                 # SASS files
│   └── views/                # Blade templates (50 files)
│       ├── auth/             # Authentication views
│       ├── layouts/          # Layout templates
│       ├── privacy.blade.php
│       ├── pdfView.blade.php
│       └── ...
├── routes/
│   ├── api.php               # API routes
│   ├── auth.php              # Authentication routes
│   ├── channels.php          # Broadcast channels
│   ├── console.php           # Console commands
│   └── web.php               # Web routes
├── storage/                  # Application storage
│   ├── app/
│   ├── framework/
│   └── logs/
├── tests/                    # PHPUnit tests
├── vendor/                   # Composer dependencies
├── .env                      # Environment configuration
├── composer.json             # PHP dependencies
├── package.json              # NPM dependencies
├── tailwind.config.js        # Tailwind configuration
├── vite.config.js            # Vite build configuration
└── artisan                   # Laravel CLI
```

---

## Third-Party Integrations

### 1. Shibboleth SSO
**Package:** `uabookstores/laravel-shibboleth`
**Purpose:** University single sign-on
**Config:** `config/shibboleth.php`

### 2. LDAP/Active Directory
**Package:** `directorytree/ldaprecord-laravel`
**Purpose:** LDAP authentication and user sync
**Config:** `config/ldap.php`
**Fields Synced:** guid, domain, email, name

### 3. SAML Identity Provider
**Package:** `codegreencreative/laravel-samlidp`
**Purpose:** Act as SAML IdP for external services
**Config:** `config/samlidp.php`

### 4. DICOM Web Viewer
**Package:** `dwv` (JavaScript)
**Purpose:** Medical image viewing in browser
**Integration:** Custom controller + JavaScript

### 5. PDF Generation
**Package:** `barryvdh/laravel-dompdf`
**Purpose:** Generate PDFs from HTML
**Usage:** Reports, documents, certificates

### 6. Excel Import/Export
**Packages:**
- `maatwebsite/excel` - Laravel Excel
- `maatwebsite/laravel-nova-excel` - Nova integration
- `simonhamp/laravel-nova-csv-import` - CSV import for Nova
**Purpose:** Bulk data import/export

### 7. Laravel Scout
**Package:** `laravel/scout`
**Purpose:** Full-text search (PathPots)
**Models:** PathPots is searchable

### 8. Mailgun
**Package:** `symfony/mailgun-mailer`
**Purpose:** Email delivery
**Usage:** Password resets, notifications

---

## Database Schema

### Key Tables

#### users
```sql
- id
- name
- email
- username
- password
- role_id (FK -> roles)
- student_number
- first_name
- known_as
- dob
- age
- gender
- year
- rotation_group
- workshop_group
- car_owner
- gp_teacher (FK -> gp_teachers)
- facilitator_id (FK -> facilitators)
- locations_id (FK -> locations)
- category_id (FK -> categories)
- guid (LDAP)
- domain (LDAP)
- avatar
- active
- remember_token
- email_verified_at
- created_at
- updated_at
```

#### students (legacy)
```sql
- id
- name
- bsms_id
- student_number
- firstname
- known_as
- dob
- age
- email
- rotation_group
- year
- gp_teacher (FK)
- location_id (FK)
- guid
- domain
- created_at
- updated_at
```

#### placements
```sql
- id
- name
- surgery
- student_id (FK -> users)
- created_at
- updated_at
```

#### notes
```sql
- id
- name
- administrator (FK -> users)
- email
- urlCode
- video
- category_id (FK -> categories)
- module_101_id (FK)
- module_102_id (FK)
- created_at
- updated_at
- deleted_at (soft deletes)
```

#### pathpots
```sql
- id
- name
- administrator
- urlCode
- email (FK -> users)
- course
- category_id (FK -> categories)
- created_at
- updated_at
```

#### dissections
```sql
- id
- name
- video
- category_id (FK -> categories)
- email
- created_at
- updated_at
```

#### physquiz
```sql
- id
- name
- urlCode
- url
- content_type
- file_path
- created_at
- updated_at
```

#### dicom
```sql
- id
- name
- filename
- study_id
- series_id
- patient_id
- study_date
- modality
- created_at
- updated_at
```

#### spotters
```sql
- id
- name
- image
- answer
- category_id (FK -> categories)
- created_at
- updated_at
```

#### categories
```sql
- id
- name
- slug
- description
- created_at
- updated_at
```

#### roles
```sql
- id
- name
- description
- created_at
- updated_at
```

#### gp_teachers
```sql
- id
- name
- email
- practice_name
- location_id (FK -> locations)
- created_at
- updated_at
```

#### facilitators
```sql
- id
- name
- email
- specialty
- location_id (FK -> locations)
- created_at
- updated_at
```

#### locations
```sql
- id
- name
- address
- type (GP/Hospital)
- capacity
- created_at
- updated_at
```

#### workshops
```sql
- id
- name
- date
- location
- facilitator_id (FK -> facilitators)
- created_at
- updated_at
```

#### groups
```sql
- id
- name
- year
- created_at
- updated_at
```

#### videos
```sql
- id
- name
- video
- created_at
- updated_at
```

#### biomedeng
```sql
- id
- name
- urlCode
- category_id (FK -> categories)
- created_at
- updated_at
```

#### module_101 / module_102
```sql
- id
- name
- description
- created_at
- updated_at
```

---

## Frontend Components

### Vue.js Components
Located in: `resources/js/components/`

**Integration:** Vue 3 + Inertia.js + Vuex

### Key Pages/Views
Located in: `resources/views/`

1. **Authentication**
   - Login
   - Registration
   - Password reset
   - Email verification

2. **Student Dashboard**
   - Placement list
   - Workshop schedule
   - GP teacher info
   - Resources

3. **Content Viewers**
   - Video player
   - DICOM viewer
   - NIfTI viewer
   - PDF viewer
   - 3D model viewer

4. **Resource Libraries**
   - Notes browser
   - PathPots browser
   - Dissections gallery
   - Spotters quiz
   - Physquiz interface

5. **Admin Dashboard (Nova)**
   - User management
   - Content management
   - Analytics
   - Reports

---

## Security Features

### Active Security Measures
1. **CSRF Protection** - VerifyCsrfToken middleware
2. **Encrypted Cookies** - EncryptCookies middleware
3. **API Rate Limiting** - throttle:api middleware
4. **Custom CORS Middleware** - CORS configuration
5. **Input Sanitization** - TrimStrings middleware
6. **Role-Based Access Control** - Custom authorization
7. **Password Hashing** - Bcrypt
8. **Sanctum Token Authentication** - API security
9. **HTTPS Enforcement** (production)

### Authentication Security
- Multiple authentication backends (Shibboleth, LDAP, SAML)
- Password reset with email verification
- Email verification for registration
- Remember token for persistent sessions

---

## Key Workflows

### 1. Student Placement Workflow
1. Student logs in via Shibboleth/LDAP
2. Student assigned to GP teacher and location
3. Student creates placement entries
4. Placements tracked with date and surgery type
5. Admin/facilitator reviews placements in Nova

### 2. Content Delivery Workflow
1. Admin uploads content via Nova
2. Content categorized by module/category
3. Students browse content by category
4. Students view videos/images/3D models
5. View tracking recorded (NoteView)

### 3. Assessment Workflow
1. Student accesses Physquiz/Spotters
2. Student views questions/models
3. Student submits answers
4. Results tracked

### 4. User Management Workflow
1. Admin imports users via CSV (Nova)
2. User receives invitation email
3. User activates account via Shibboleth/LDAP
4. User profile synced from LDAP
5. User assigned role, GP teacher, location

---

## Environment Variables (Key)

```env
APP_NAME=BSMS Placements
APP_ENV=production
APP_URL=https://placements.bsms.ac.uk

DB_CONNECTION=mysql
DB_HOST=...
DB_DATABASE=...

LDAP_CONNECTION=default
LDAP_HOST=...
LDAP_USERNAME=...

SHIBBOLETH_IDP_URL=...

NOVA_ACCESS_ROLES=admin,supervisor

MAIL_MAILER=mailgun
MAILGUN_DOMAIN=...
MAILGUN_SECRET=...

SANCTUM_STATEFUL_DOMAINS=...
```

---

## Development Notes

### Recent Updates (2025)
- Fixed Physquiz Nova resource for URL and file uploads
- Implemented proper content_type handling
- Added manual URL input support
- Improved form validation
- Enhanced logging for debugging

### Known Issues
- User vs Student model overlap (consider consolidation)
- Multiple Role models (Role, Role2)
- Some legacy code and commented sections

### Future Enhancements
- Mobile app development
- Enhanced analytics dashboard
- Video streaming optimization
- Advanced search functionality
- Automated email notifications
- Two-factor authentication

---

## Migration to Wagtail Considerations

### Wagtail CMS Mapping

#### Page Types Needed
1. **Home Page** - Landing
2. **Resource Library Page** - Content browser
3. **Video Page** - Video content
4. **Image Page** - Medical images
5. **Quiz Page** - Assessments
6. **User Dashboard Page** - Personalized view

#### Django Models to Create
- User (extend AbstractUser)
- Student (profile extension)
- Placement
- Note
- PathPot
- Dissection
- Physquiz
- Dicom
- Spotter
- Category
- Role
- GPTeacher
- Facilitator
- Location
- Workshop

#### Authentication
- Django Allauth for social auth
- python-ldap for LDAP
- djangosaml2 for SAML
- Django REST Framework Token auth (replace Sanctum)

#### File Handling
- Wagtail Documents for PDFs
- Wagtail Images for photos
- Custom storage for DICOM/NIfTI
- Django Storage for videos

#### Admin Interface
- Wagtail admin replaces Nova
- ModelAdmin for custom models
- Custom dashboard widgets for metrics
- Permission groups for role-based access

#### Frontend
- Wagtail StreamField for flexible content
- Django templates (replace Blade)
- Vue.js integration via Django REST Framework
- Static files with WhiteNoise or CDN

#### API
- Django REST Framework
- ViewSets for CRUD operations
- Token authentication
- CORS configuration

---

## Deployment Architecture

### Current Setup
- **Web Server:** Apache/Nginx
- **PHP:** 8.0.2+
- **Database:** MySQL
- **Queue:** Laravel Queue (optional)
- **Cache:** Redis (optional)

### Production Requirements
- HTTPS with SSL certificate
- Database backups
- Log monitoring
- Error tracking (Sentry, etc.)
- CDN for static assets
- Email service (Mailgun)

---

## Contact & Documentation
- **Repository:** https://github.com/bsms66366/placements.bsms.ac.uk.git
- **Internal Docs:** `/app/nova_access.md`, `/app/ADMIN_CARD_SETUP.md`
- **Security Assessment:** `/security_assessment.md`

---

**Document Version:** 1.0
**Date:** December 16, 2025
**Author:** System Documentation
**Purpose:** Wagtail Migration Reference
