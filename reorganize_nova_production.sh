#!/bin/bash

# Script to reorganize Nova resources on production server
# Run this on the production server: bash reorganize_nova_production.sh

set -e  # Exit on error

NOVA_DIR="/var/www/html/placements.bsms.ac.uk/app/Nova"

echo "Starting Nova resource reorganization..."
echo "Working directory: $NOVA_DIR"

# Navigate to Nova directory
cd "$NOVA_DIR"

# Create subdirectories if they don't exist
echo "Creating subdirectories..."
mkdir -p Anatomy
mkdir -p Physiology
mkdir -p GPClinicalSkills
mkdir -p Admin
mkdir -p Shared

# Move Anatomy resources
echo "Moving Anatomy resources..."
[ -f "Anatomy.php" ] && mv -v "Anatomy.php" "Anatomy/" || echo "Anatomy.php already in place or doesn't exist"
[ -f "PathPots.php" ] && mv -v "PathPots.php" "Anatomy/" || echo "PathPots.php already in place or doesn't exist"
[ -f "Spotters.php" ] && mv -v "Spotters.php" "Anatomy/" || echo "Spotters.php already in place or doesn't exist"
[ -f "Nifti.php" ] && mv -v "Nifti.php" "Anatomy/" || echo "Nifti.php already in place or doesn't exist"
[ -f "Dicom.php" ] && mv -v "Dicom.php" "Anatomy/" || echo "Dicom.php already in place or doesn't exist"
[ -f "Notes.php" ] && mv -v "Notes.php" "Anatomy/" || echo "Notes.php already in place or doesn't exist"
[ -f "Category.php" ] && mv -v "Category.php" "Anatomy/" || echo "Category.php already in place or doesn't exist"
[ -f "NoteInsight.php" ] && mv -v "NoteInsight.php" "Anatomy/" || echo "NoteInsight.php already in place or doesn't exist"
[ -f "FilteredNoteResource.php" ] && mv -v "FilteredNoteResource.php" "Anatomy/" || echo "FilteredNoteResource.php already in place or doesn't exist"
[ -f "FilteredPotResource.php" ] && mv -v "FilteredPotResource.php" "Anatomy/" || echo "FilteredPotResource.php already in place or doesn't exist"

# Move Physiology resources
echo "Moving Physiology resources..."
[ -f "Physquiz.php" ] && mv -v "Physquiz.php" "Physiology/" || echo "Physquiz.php already in place or doesn't exist"
[ -f "Biomedeng.php" ] && mv -v "Biomedeng.php" "Physiology/" || echo "Biomedeng.php already in place or doesn't exist"

# Move GP/Clinical Skills resources
echo "Moving GP/Clinical Skills resources..."
[ -f "Student.php" ] && mv -v "Student.php" "GPClinicalSkills/" || echo "Student.php already in place or doesn't exist"
[ -f "Location.php" ] && mv -v "Location.php" "GPClinicalSkills/" || echo "Location.php already in place or doesn't exist"
[ -f "Location2025.php" ] && mv -v "Location2025.php" "GPClinicalSkills/" || echo "Location2025.php already in place or doesn't exist"
[ -f "LocationSignoff.php" ] && mv -v "LocationSignoff.php" "GPClinicalSkills/" || echo "LocationSignoff.php already in place or doesn't exist"
[ -f "LocationCategory.php" ] && mv -v "LocationCategory.php" "GPClinicalSkills/" || echo "LocationCategory.php already in place or doesn't exist"
[ -f "ClinicalGroup.php" ] && mv -v "ClinicalGroup.php" "GPClinicalSkills/" || echo "ClinicalGroup.php already in place or doesn't exist"
[ -f "GPTeacher.php" ] && mv -v "GPTeacher.php" "GPClinicalSkills/" || echo "GPTeacher.php already in place or doesn't exist"
[ -f "Facilitator.php" ] && mv -v "Facilitator.php" "GPClinicalSkills/" || echo "Facilitator.php already in place or doesn't exist"
[ -f "Group.php" ] && mv -v "Group.php" "GPClinicalSkills/" || echo "Group.php already in place or doesn't exist"
[ -f "Invitation.php" ] && mv -v "Invitation.php" "GPClinicalSkills/" || echo "Invitation.php already in place or doesn't exist"
[ -f "MonitoredSessions2026.php" ] && mv -v "MonitoredSessions2026.php" "GPClinicalSkills/" || echo "MonitoredSessions2026.php already in place or doesn't exist"
[ -f "SessionAttendance2026.php" ] && mv -v "SessionAttendance2026.php" "GPClinicalSkills/" || echo "SessionAttendance2026.php already in place or doesn't exist"
[ -f "Workshops.php" ] && mv -v "Workshops.php" "GPClinicalSkills/" || echo "Workshops.php already in place or doesn't exist"
[ -f "Module101.php" ] && mv -v "Module101.php" "GPClinicalSkills/" || echo "Module101.php already in place or doesn't exist"
[ -f "Module102.php" ] && mv -v "Module102.php" "GPClinicalSkills/" || echo "Module102.php already in place or doesn't exist"
[ -f "IAP.php" ] && mv -v "IAP.php" "GPClinicalSkills/" || echo "IAP.php already in place or doesn't exist"
[ -f "Examination.php" ] && mv -v "Examination.php" "GPClinicalSkills/" || echo "Examination.php already in place or doesn't exist"
[ -f "ExaminationResult.php" ] && mv -v "ExaminationResult.php" "GPClinicalSkills/" || echo "ExaminationResult.php already in place or doesn't exist"
[ -f "PhaseOneStaff.php" ] && mv -v "PhaseOneStaff.php" "GPClinicalSkills/" || echo "PhaseOneStaff.php already in place or doesn't exist"
[ -f "Rooms.php" ] && mv -v "Rooms.php" "GPClinicalSkills/" || echo "Rooms.php already in place or doesn't exist"
[ -f "ExternalSite.php" ] && mv -v "ExternalSite.php" "GPClinicalSkills/" || echo "ExternalSite.php already in place or doesn't exist"

# Move Admin resources
echo "Moving Admin resources..."
[ -f "User.php" ] && mv -v "User.php" "Admin/" || echo "User.php already in place or doesn't exist"
[ -f "Role.php" ] && mv -v "Role.php" "Admin/" || echo "Role.php already in place or doesn't exist"

# Move Shared resources
echo "Moving Shared resources..."
[ -f "Video.php" ] && mv -v "Video.php" "Shared/" || echo "Video.php already in place or doesn't exist"
[ -f "Directory.php" ] && mv -v "Directory.php" "Shared/" || echo "Directory.php already in place or doesn't exist"
[ -f "UserRegistration.php" ] && mv -v "UserRegistration.php" "Shared/" || echo "UserRegistration.php already in place or doesn't exist"
[ -f "UserInsight.php" ] && mv -v "UserInsight.php" "Shared/" || echo "UserInsight.php already in place or doesn't exist"

# Remove old duplicate files if they exist
echo "Cleaning up duplicate files..."
[ -f "Dissection.php" ] && rm -v "Dissection.php" && echo "Removed duplicate Dissection.php from root"

echo ""
echo "Reorganization complete!"
echo ""
echo "Next steps:"
echo "1. Run: cd /var/www/html/placements.bsms.ac.uk"
echo "2. Run: composer dump-autoload"
echo "3. Run: php artisan optimize:clear"
echo "4. Run: sudo systemctl restart php-fpm"
echo "5. Test: php artisan tinker --execute=\"echo class_exists('App\\Nova\\Anatomy\\PathPots') ? 'Class exists' : 'Class not found';\""
