# 🧭 Laravel Nova Access Control Guide

This document explains how **Laravel Nova access control** works in this project.

Nova is the **admin backend** used by staff members only.  
Students and frontend users **do not** log in to or interact with Nova directly.

---

## ⚙️ Overview

Nova access is granted dynamically based on a user’s **role**.  
Each user is linked to a role via the `users.role_id` column.

| Model | Relationship | Purpose |
|--------|---------------|----------|
| `User` | belongsTo(`Role`) | Each user has a single role |
| `Role` | hasMany(`User`) | Defines the role type (e.g. admin, supervisor, teacher) |

---

## 🔐 Access to Nova

### Who Can Log In

Only users whose roles are listed in the `.env` file under `NOVA_ACCESS_ROLES` can access Nova.

Example:
```env
NOVA_ACCESS_ROLES=admin,supervisor
