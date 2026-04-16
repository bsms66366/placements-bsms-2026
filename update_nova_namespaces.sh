#!/bin/bash

# Script to update namespaces in reorganized Nova resources
# Run this AFTER reorganize_nova_production.sh
# Run on production server: bash update_nova_namespaces.sh

set -e  # Exit on error

NOVA_DIR="/var/www/html/placements.bsms.ac.uk/app/Nova"

echo "Updating namespaces in Nova resources..."
echo "Working directory: $NOVA_DIR"

cd "$NOVA_DIR"

# Update Anatomy resources
echo "Updating Anatomy namespaces..."
for file in Anatomy/*.php; do
    if [ -f "$file" ]; then
        echo "Processing $file..."
        sed -i 's/^namespace App\\Nova;$/namespace App\\Nova\\Anatomy;/' "$file"
    fi
done

# Update Physiology resources
echo "Updating Physiology namespaces..."
for file in Physiology/*.php; do
    if [ -f "$file" ]; then
        echo "Processing $file..."
        sed -i 's/^namespace App\\Nova;$/namespace App\\Nova\\Physiology;/' "$file"
    fi
done

# Update GPClinicalSkills resources
echo "Updating GPClinicalSkills namespaces..."
for file in GPClinicalSkills/*.php; do
    if [ -f "$file" ]; then
        echo "Processing $file..."
        sed -i 's/^namespace App\\Nova;$/namespace App\\Nova\\GPClinicalSkills;/' "$file"
    fi
done

# Update Admin resources
echo "Updating Admin namespaces..."
for file in Admin/*.php; do
    if [ -f "$file" ]; then
        echo "Processing $file..."
        sed -i 's/^namespace App\\Nova;$/namespace App\\Nova\\Admin;/' "$file"
    fi
done

# Update Shared resources
echo "Updating Shared namespaces..."
for file in Shared/*.php; do
    if [ -f "$file" ]; then
        echo "Processing $file..."
        sed -i 's/^namespace App\\Nova;$/namespace App\\Nova\\Shared;/' "$file"
    fi
done

echo ""
echo "Namespace updates complete!"
echo ""
echo "Verifying changes..."
echo "Anatomy namespace samples:"
head -n 5 Anatomy/PathPots.php 2>/dev/null | grep namespace || echo "PathPots.php not found"
echo ""
echo "Physiology namespace samples:"
head -n 5 Physiology/Physquiz.php 2>/dev/null | grep namespace || echo "Physquiz.php not found"
