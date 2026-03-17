# Nova Resources Organization

Your Nova resources have been organized into **5 folders** based on project areas:

## Folder Structure

```
app/Nova/
├── Anatomy/              (6 resources)
├── Physiology/           (2 resources)
├── GPClinicalSkills/     (20 resources)
├── Admin/                (2 resources)
├── Shared/               (10 resources)
├── Actions/
├── Cards/
├── Dashboards/
├── Fields/
├── Filters/
├── Lenses/
├── Metrics/
└── Resource.php          (Base resource class)
```

## Resources by Folder

### Anatomy (11 resources)
- Anatomy
- Dissection
- PathPots
- Spotters
- Nifti
- Dicom
- Notes
- Category
- NoteInsight
- FilteredNoteResource
- FilteredPotResource

### Physiology (2 resources)
- Physquiz
- Biomedeng

### GP/Clinical Skills (21 resources)
- Student
- Location
- Location2025
- LocationSignoff
- LocationCategory
- ClinicalGroup
- GPTeacher
- Facilitator
- Group
- Invitation
- MonitoredSessions2026
- SessionAttendance2026
- Workshops
- Module101
- Module102
- IAP
- Examination
- ExaminationResult
- PhaseOneStaff
- Rooms
- ExternalSite

### Admin (2 resources)
- User
- Role

### Shared (4 resources)
- Video
- Directory
- UserRegistration
- UserInsight

## Changes Made

1. **Namespaces Updated**: All resources now use namespaced classes:
   - `App\Nova\Anatomy\*`
   - `App\Nova\Physiology\*`
   - `App\Nova\GPClinicalSkills\*`
   - `App\Nova\Admin\*`
   - `App\Nova\Shared\*`

2. **NovaServiceProvider Updated**: Changed from auto-discovery to explicit registration with organized comments

3. **Cross-references Fixed**: Updated BelongsTo relationships to use new namespaces

4. **Sidebar Groups Added**: All resources now have a `$group` property that organizes them in the Nova sidebar:
   - Anatomy group
   - Physiology group
   - GP/Clinical Skills group
   - Admin group
   - Shared group

## Adding New Resources

When creating new resources, place them in the appropriate folder and:

1. Set the correct namespace (e.g., `namespace App\Nova\Anatomy;`)
2. Import the base Resource class: `use App\Nova\Resource;`
3. Register in `app/Providers/NovaServiceProvider.php` under the appropriate section

## Example

```php
<?php

namespace App\Nova\Anatomy;

use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class NewAnatomyResource extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Anatomy';

    public static $model = \App\Models\NewAnatomyModel::class;
    
    // ... rest of resource definition
}
```

Then add to NovaServiceProvider:
```php
// Anatomy Resources
\App\Nova\Anatomy\Anatomy::class,
\App\Nova\Anatomy\NewAnatomyResource::class, // <-- Add here
```
