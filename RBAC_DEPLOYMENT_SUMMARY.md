# Nova RBAC Deployment Summary
**Date:** July 10, 2026  
**Project:** placements.bsms.ac.uk  
**Objective:** Deploy role-based access control (RBAC) to Laravel Nova

---

## 🎯 Final Status

**Current State:** Reverted to flat structure with role-based gate  
**Nova Status:** Accessible with email whitelist (temporary)  
**RBAC Status:** Partially implemented, needs completion

---

## 📋 What Was Accomplished

### 1. Created RBAC Infrastructure (Local)
- ✅ Created `GroupPolicy.php` - Base policy with superuser bypass
- ✅ Created specific policies: `AnatomyPolicy`, `PhysiologyPolicy`, `GPClinicalSkillsPolicy`, `SharedPolicy`
- ✅ Updated `UserPolicy` and `RolePolicy` to extend `GroupPolicy`
- ✅ Created `RolesSeeder.php` with new granular roles
- ✅ Updated `Resource.php` with group-based authorization
- ✅ Fixed `User` model's `hasRole()` and `hasAnyRole()` methods
- ✅ Registered all policies in `AuthServiceProvider`

### 2. Roles Created
```php
- superuser      // Full access to everything
- admin          // Access to Admin section + all resources
- anatomy_editor // Access to Anatomy resources only
- physiology_editor // Access to Physiology resources only
- gp_editor      // Access to GP/Clinical Skills resources only
- shared_editor  // Access to Shared resources only
```

### 3. Environment Configuration
```env
NOVA_ACCESS_ROLES=superuser,admin,anatomy_editor,physiology_editor,gp_editor,shared_editor
```

---

## 🔧 Production Server Changes Made

### Files Modified on Server:
1. **NovaServiceProvider.php**
   - Uncommented `routes()` method (was causing 404)
   - Gate still uses email whitelist (needs update to roles)

2. **composer.json**
   - Added `"bsms/all-students-attendance"` to `dont-discover`

3. **Caches Cleared**
   - Config cache
   - Route cache
   - View cache
   - Optimized autoload

---

## ⚠️ Issues Encountered

### 1. Subdirectory Structure Migration Failed
**Problem:** Attempted to move Nova resources from flat structure to subdirectories  
**Result:** Resources failed to register, Nova showed 0 resources  
**Cause:** Namespace mismatches and missing `use App\Nova\Resource` statements  
**Resolution:** Reverted to flat structure via `git checkout`

### 2. Routes Commented Out
**Problem:** Git checkout restored old version with `routes()` method commented  
**Result:** 404 error on `/nova`  
**Resolution:** Manually uncommented the `routes()` method

### 3. AllStudentsAttendance Component Error
**Problem:** `process is not defined` JavaScript error  
**Result:** Broke Nova's JavaScript, prevented navigation from loading  
**Resolution:** Disabled package discovery for the component

---

## 📁 File Structure

### Current Production (Flat):
```
app/Nova/
├── Resource.php (base class - reverted to original)
├── User.php
├── Role.php
├── Dissection.php
├── PathPots.php
├── Spotters.php
└── ... (all other resources)
```

### Local Development (Subdirectories):
```
app/Nova/
├── Resource.php (with RBAC authorization)
├── Admin/
│   ├── User.php
│   └── Role.php
├── Anatomy/
│   ├── Anatomy.php
│   ├── Dissection.php
│   ├── PathPots.php
│   └── ...
├── Physiology/
│   ├── Physquiz.php
│   └── Biomedeng.php
├── GPClinicalSkills/
│   ├── Student.php
│   ├── Location.php
│   └── ...
└── Shared/
    ├── Video.php
    ├── Directory.php
    └── ...
```

---

## 🔄 Next Steps to Complete RBAC Deployment

### Option 1: Keep Flat Structure (Recommended for Production)
1. Update production `NovaServiceProvider.php` gate method:
   ```php
   protected function gate()
   {
       $allowedRoles = explode(',', env('NOVA_ACCESS_ROLES', 'admin,supervisor'));
       
       Gate::define('viewNova', function ($user) use ($allowedRoles) {
           return $user->hasAnyRole($allowedRoles);
       });
   }
   ```

2. Deploy RBAC files to production:
   - `app/Policies/GroupPolicy.php`
   - `app/Policies/AnatomyPolicy.php`
   - `app/Policies/PhysiologyPolicy.php`
   - `app/Policies/GPClinicalSkillsPolicy.php`
   - `app/Policies/SharedPolicy.php`
   - Updated `app/Policies/UserPolicy.php`
   - Updated `app/Policies/RolePolicy.php`
   - `database/seeders/RolesSeeder.php`
   - Updated `app/Providers/AuthServiceProvider.php`
   - Updated `app/Models/User.php` (hasRole/hasAnyRole fix)

3. Update `app/Nova/Resource.php` with authorization logic (flat namespace version)

4. Run on production:
   ```bash
   php artisan db:seed --class=RolesSeeder --force
   composer dump-autoload --optimize --no-scripts
   php artisan optimize:clear
   sudo systemctl restart php-fpm
   ```

5. Assign roles to users via Nova

### Option 2: Migrate to Subdirectory Structure (Future)
1. Test thoroughly on local/staging first
2. Create deployment script to:
   - Copy all subdirectory files
   - Update NovaServiceProvider with namespaced resources
   - Ensure all cross-references are updated
3. Deploy during maintenance window
4. Verify all resources load correctly

---

## 🐛 Known Issues to Fix

1. **AllStudentsAttendance Component**
   - Needs rebuild with proper environment variable handling
   - Currently disabled via package discovery

2. **User Model Role Methods**
   - Fixed locally but not deployed to production
   - Current production version has `role` attribute conflict

3. **Anatomy.php Resource**
   - Exists locally but not on production
   - Referenced in local NovaServiceProvider

---

## 📝 Important Code Snippets

### Fixed User Model Methods (Local)
```php
public function hasRole($roleName)
{
    return $this->role()->value('name') === $roleName;
}

public function hasAnyRole(array $roles)
{
    return in_array($this->role()->value('name'), $roles);
}
```

### GroupPolicy Base Class
```php
abstract class GroupPolicy
{
    protected static function allowedRoles(): array
    {
        return [];
    }

    public function before($user, $ability)
    {
        if ($user->hasRole('superuser')) {
            return true;
        }
    }

    public function viewAny($user)
    {
        return $user->hasAnyRole(static::allowedRoles());
    }
    // ... other CRUD methods
}
```

### Resource.php Authorization (Local)
```php
private static function groupRoles(): array
{
    return [
        'Admin'              => ['superuser', 'admin'],
        'Anatomy'            => ['superuser', 'anatomy_editor'],
        'Physiology'         => ['superuser', 'physiology_editor'],
        'GP/Clinical Skills' => ['superuser', 'gp_editor'],
        'Shared'             => ['superuser', 'shared_editor'],
    ];
}

public static function authorizedToViewAny(Request $request): bool
{
    return static::userHasGroupAccess($request);
}
```

---

## 🔐 Security Notes

- Superuser role has full access via `before()` hook in `GroupPolicy`
- Email whitelist still active on production (temporary fallback)
- Role-based access requires users to have `role_id` set
- `NOVA_ACCESS_ROLES` controls overall Nova access at gate level

---

## 📊 Server Information

- **Server:** bsms-web-pro01.brighton.ac.uk
- **Path:** /var/www/placements.bsms.ac.uk
- **PHP Version:** 8.3.31
- **Nova Version:** 5.8.2
- **Laravel Version:** (check composer.json)
- **Git Remote:** https://repos.brighton.ac.uk/bsms-tel/anatomy.git

---

## 🎓 Lessons Learned

1. **Always test structure changes locally first** - The subdirectory migration broke production
2. **Git checkout can restore old code** - Routes were commented in old version
3. **Namespace changes are complex** - Requires updating all cross-references
4. **Cache clearing is critical** - OPcache, config, routes all need clearing
5. **Backup before major changes** - Git revert saved us but lost some work

---

## ✅ Verification Checklist (When Deploying)

- [ ] Roles exist in database
- [ ] Users have `role_id` assigned
- [ ] `NOVA_ACCESS_ROLES` set in `.env`
- [ ] NovaServiceProvider gate uses roles
- [ ] All policies registered in AuthServiceProvider
- [ ] User model has fixed `hasRole`/`hasAnyRole` methods
- [ ] Composer autoload optimized
- [ ] All caches cleared
- [ ] PHP-FPM restarted
- [ ] Test superuser can see all resources
- [ ] Test restricted roles see only their resources
- [ ] Test non-Nova users cannot access Nova

---

**End of Summary**
