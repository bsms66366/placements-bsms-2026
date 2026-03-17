# 📋 Admin Access Info Card - Setup Guide

## What Was Created

A custom Nova dashboard metric that displays the admin access control documentation directly in your Nova dashboard.

### Files Created

1. **`app/Nova/Metrics/AdminAccessGuide.php`**
   - Custom Nova Value metric class
   - Reads `app/nova_access.md` and converts it to styled HTML
   - Only visible to users with `admin` role
   - Displays as a full-width card on the dashboard

2. **`app/Nova/Dashboards/Main.php`** (modified)
   - Added the metric to the main dashboard

---

## How It Works

### 1. **Metric Visibility**
The metric uses the `canSee()` method to restrict visibility:

```php
public function canSee($request)
{
    return optional($request->user()?->role)->name === 'admin';
}
```

Only users with the `admin` role will see this metric.

### 2. **Dynamic Content**
The metric reads `app/nova_access.md` and converts markdown to HTML on-the-fly:

```php
$markdownContent = File::get(app_path('nova_access.md'));
$htmlContent = $this->convertMarkdownToHtml($markdownContent);
return $this->result($htmlContent);
```

### 3. **Styling**
Uses inline CSS styles for consistent rendering across Nova versions.

---

## Customization Options

### Change Metric Width
In `AdminAccessGuide.php`, modify the `$width` property:

```php
public $width = 'full';  // Options: '1/3', '1/2', '2/3', 'full'
```

### Change Visibility Rules
Modify the `canSee()` method to show to different roles:

```php
public function canSee($request)
{
    // Show to admins and supervisors
    return in_array(optional($request->user()?->role)->name, ['admin', 'supervisor']);
}
```

### Change Position on Dashboard
In `Main.php`, move the metric in the `cards()` array:

```php
return [
    new NewUsers(),
    new AdminAccessGuide(),  // Move it here
    new SessionNotes(),
    // ...
];
```

### Use Different Markdown File
Change the file path in `calculate()` method:

```php
$markdownContent = File::get(base_path('docs/my-custom-doc.md'));
```

---

## Adding More Info Metrics

To create additional info metrics for different documentation:

1. **Copy the metric class:**
   ```bash
   cp app/Nova/Metrics/AdminAccessGuide.php app/Nova/Metrics/MyNewGuide.php
   ```

2. **Update the class name and content:**
   ```php
   class MyNewGuide extends Value
   {
       public function calculate(NovaRequest $request)
       {
           $markdownContent = File::get(app_path('my-other-doc.md'));
           $htmlContent = $this->convertMarkdownToHtml($markdownContent);
           return $this->result($htmlContent)->format('0')->allowZeroResult();
       }
       
       public function name()
       {
           return '📚 My New Documentation';
       }
       
       public function uriKey()
       {
           return 'my-new-guide';
       }
   }
   ```

3. **Add to dashboard:**
   ```php
   use App\Nova\Metrics\MyNewGuide;
   
   public function cards()
   {
       return [
           new AdminAccessGuide(),
           new MyNewGuide(),
           // ...
       ];
   }
   ```

---

## Testing

1. **Clear cache:**
   ```bash
   php artisan cache:clear && php artisan config:clear
   ```

2. **Log in as an admin** and visit the Nova dashboard

3. **Verify:**
   - Metric appears at the top of the dashboard
   - Content is properly formatted with your markdown documentation
   - Metric is NOT visible to non-admin users

---

## Troubleshooting

### Metric doesn't appear
- Clear cache: `php artisan cache:clear && php artisan config:clear`
- Check user role: Ensure logged-in user has `admin` role
- Check file exists: Verify `app/nova_access.md` exists
- Check for PHP errors in Laravel logs

### Formatting issues
- The markdown converter is basic and handles common markdown syntax
- Tables display as flex rows for simplicity
- For complex formatting, consider using a package like `league/commonmark`

### Metric appears for non-admins
- Check the `canSee()` method logic in `AdminAccessGuide.php`
- Verify role names match exactly (case-sensitive)
- Use `$request->user()?->role` with null-safe operator

---

## Future Enhancements

Consider these improvements:

1. **Use a proper Markdown parser:**
   ```bash
   composer require league/commonmark
   ```

2. **Cache the HTML output:**
   ```php
   return Cache::remember('admin-access-info', 3600, function() {
       return $this->convertMarkdownToHtml($markdownContent);
   });
   ```

3. **Add edit link:**
   ```php
   'helpText' => $html . '<a href="/admin/docs/edit" class="text-blue-500">Edit Documentation</a>'
   ```

4. **Make it collapsible:**
   Add JavaScript to toggle content visibility

---

## Related Files

- **Documentation:** `app/nova_access.md`
- **Metric Class:** `app/Nova/Metrics/AdminAccessGuide.php`
- **Dashboard:** `app/Nova/Dashboards/Main.php`
- **Nova Service Provider:** `app/Providers/NovaServiceProvider.php`

---

## Why Use a Metric Instead of a Card?

Nova's built-in card components have specific behaviors and default content that's difficult to override. By using a **Value metric**, we get:

1. **Full control** over the displayed content
2. **No default content** interference
3. **Simple implementation** - just return HTML as the "value"
4. **Consistent styling** across Nova versions
5. **Easy to extend** for additional documentation displays

The metric displays your markdown documentation as formatted HTML in a clean, full-width card on the dashboard.
