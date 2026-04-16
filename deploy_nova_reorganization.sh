#!/bin/bash

# Complete deployment script for Nova reorganization on production
# Run this on the production server

set -e  # Exit on error

APP_DIR="/var/www/html/placements.bsms.ac.uk"
NOVA_DIR="$APP_DIR/app/Nova"

echo "=========================================="
echo "Nova Resource Reorganization - Production"
echo "=========================================="
echo ""

# Step 1: Reorganize files
echo "STEP 1: Reorganizing Nova files into subfolders..."
cd "$NOVA_DIR"

mkdir -p Anatomy Physiology GPClinicalSkills Admin Shared

# Anatomy
[ -f "Anatomy.php" ] && mv -v "Anatomy.php" "Anatomy/"
[ -f "PathPots.php" ] && mv -v "PathPots.php" "Anatomy/"
[ -f "Spotters.php" ] && mv -v "Spotters.php" "Anatomy/"
[ -f "Nifti.php" ] && mv -v "Nifti.php" "Anatomy/"
[ -f "Dicom.php" ] && mv -v "Dicom.php" "Anatomy/"
[ -f "Notes.php" ] && mv -v "Notes.php" "Anatomy/"
[ -f "Category.php" ] && mv -v "Category.php" "Anatomy/"
[ -f "NoteInsight.php" ] && mv -v "NoteInsight.php" "Anatomy/"
[ -f "FilteredNoteResource.php" ] && mv -v "FilteredNoteResource.php" "Anatomy/"
[ -f "FilteredPotResource.php" ] && mv -v "FilteredPotResource.php" "Anatomy/"

# Physiology
[ -f "Physquiz.php" ] && mv -v "Physquiz.php" "Physiology/"
[ -f "Biomedeng.php" ] && mv -v "Biomedeng.php" "Physiology/"

# GPClinicalSkills
[ -f "Student.php" ] && mv -v "Student.php" "GPClinicalSkills/"
[ -f "Location.php" ] && mv -v "Location.php" "GPClinicalSkills/"
[ -f "Location2025.php" ] && mv -v "Location2025.php" "GPClinicalSkills/"
[ -f "LocationSignoff.php" ] && mv -v "LocationSignoff.php" "GPClinicalSkills/"
[ -f "LocationCategory.php" ] && mv -v "LocationCategory.php" "GPClinicalSkills/"
[ -f "ClinicalGroup.php" ] && mv -v "ClinicalGroup.php" "GPClinicalSkills/"
[ -f "GPTeacher.php" ] && mv -v "GPTeacher.php" "GPClinicalSkills/"
[ -f "Facilitator.php" ] && mv -v "Facilitator.php" "GPClinicalSkills/"
[ -f "Group.php" ] && mv -v "Group.php" "GPClinicalSkills/"
[ -f "Invitation.php" ] && mv -v "Invitation.php" "GPClinicalSkills/"
[ -f "MonitoredSessions2026.php" ] && mv -v "MonitoredSessions2026.php" "GPClinicalSkills/"
[ -f "SessionAttendance2026.php" ] && mv -v "SessionAttendance2026.php" "GPClinicalSkills/"
[ -f "Workshops.php" ] && mv -v "Workshops.php" "GPClinicalSkills/"
[ -f "Module101.php" ] && mv -v "Module101.php" "GPClinicalSkills/"
[ -f "Module102.php" ] && mv -v "Module102.php" "GPClinicalSkills/"
[ -f "IAP.php" ] && mv -v "IAP.php" "GPClinicalSkills/"
[ -f "Examination.php" ] && mv -v "Examination.php" "GPClinicalSkills/"
[ -f "ExaminationResult.php" ] && mv -v "ExaminationResult.php" "GPClinicalSkills/"
[ -f "PhaseOneStaff.php" ] && mv -v "PhaseOneStaff.php" "GPClinicalSkills/"
[ -f "Rooms.php" ] && mv -v "Rooms.php" "GPClinicalSkills/"
[ -f "ExternalSite.php" ] && mv -v "ExternalSite.php" "GPClinicalSkills/"

# Admin
[ -f "User.php" ] && mv -v "User.php" "Admin/"
[ -f "Role.php" ] && mv -v "Role.php" "Admin/"

# Shared
[ -f "Video.php" ] && mv -v "Video.php" "Shared/"
[ -f "Directory.php" ] && mv -v "Directory.php" "Shared/"
[ -f "UserRegistration.php" ] && mv -v "UserRegistration.php" "Shared/"
[ -f "UserInsight.php" ] && mv -v "UserInsight.php" "Shared/"

# Clean up duplicates
[ -f "Dissection.php" ] && rm -v "Dissection.php"

echo ""
echo "STEP 2: Updating namespaces in moved files..."

# Update namespaces
find Anatomy -name "*.php" -exec sed -i 's/^namespace App\\Nova;$/namespace App\\Nova\\Anatomy;/' {} \;
find Physiology -name "*.php" -exec sed -i 's/^namespace App\\Nova;$/namespace App\\Nova\\Physiology;/' {} \;
find GPClinicalSkills -name "*.php" -exec sed -i 's/^namespace App\\Nova;$/namespace App\\Nova\\GPClinicalSkills;/' {} \;
find Admin -name "*.php" -exec sed -i 's/^namespace App\\Nova;$/namespace App\\Nova\\Admin;/' {} \;
find Shared -name "*.php" -exec sed -i 's/^namespace App\\Nova;$/namespace App\\Nova\\Shared;/' {} \;

echo ""
echo "STEP 3: Removing PSR-4 violating files..."
cd "$APP_DIR"
rm -fv app/Http/Import.php
rm -fv app/Policies/RolePolicy1.php

echo ""
echo "STEP 4: Regenerating autoload..."
composer dump-autoload

echo ""
echo "STEP 5: Clearing all caches..."
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo ""
echo "STEP 6: Testing class loading..."
php artisan tinker --execute="echo class_exists('App\\Nova\\Anatomy\\PathPots') ? 'Class exists ✓' : 'Class not found ✗';"

echo ""
echo "=========================================="
echo "Reorganization Complete!"
echo "=========================================="
echo ""
echo "FINAL STEP: Restart PHP-FPM"
echo "Run: sudo systemctl restart php-fpm"
echo "  or: sudo systemctl restart php8.0-fpm"
echo ""
echo "Then test Nova login at: https://placements.bsms.ac.uk/nova/login"
