# Debug Google OAuth Login Issue

## Error Location

The error "Unable to login with Google. Please try again." is handled in:

**File:** `app/Http/Controllers/Auth/SocialAuthController.php`  
**Method:** `handleGoogleCallback()`  
**Line:** ~62-65 (in the catch block)

## What I Just Fixed

I've improved the error handling to:
1. ✅ Log detailed error information to `storage/logs/laravel.log`
2. ✅ Show more specific error messages based on the error type
3. ✅ Handle common OAuth errors (access_denied, redirect_uri_mismatch, etc.)
4. ✅ Check for OAuth errors in the request parameters

## How to Debug

### Step 1: Check Laravel Logs

After trying to login, check the log file:
```bash
# Windows PowerShell
Get-Content storage/logs/laravel.log -Tail 100

# Or open the file directly
notepad storage/logs/laravel.log
```

Look for entries with:
- "Google OAuth Error"
- "Google OAuth Configuration Error"
- "Google OAuth Invalid State"
- "Google OAuth HTTP Error"
- "Google OAuth General Error"

### Step 2: Check Browser Console

1. Open browser Developer Tools (F12)
2. Go to Console tab
3. Try logging in with Google
4. Check for any JavaScript errors or network errors

### Step 3: Verify Configuration

Run this command to check your Google OAuth config:
```bash
php artisan tinker
```
Then type:
```php
config('services.google')
```

Make sure:
- `client_id` matches your Google Console
- `client_secret` matches your Google Console
- `redirect` matches exactly what's in Google Console

### Step 4: Common Issues

1. **Redirect URI Mismatch**
   - Google Console: `http://127.0.0.1:8000/auth/google/callback`
   - Laravel Config: Should match exactly
   - Fix: Update `.env` `APP_URL` or add both URIs to Google Console

2. **Invalid Client Credentials**
   - Check if Client ID and Secret are correct
   - Make sure they're not expired or revoked

3. **Database Schema Issues**
   - The `role` column might not allow NULL
   - Check if migration ran successfully: `php artisan migrate:status`

4. **Session Issues**
   - Clear browser cookies
   - Try incognito/private mode

## Next Steps

After checking the logs, share the error message you see, and I can help fix the specific issue.

