# Google OAuth Setup Instructions

## Error: redirect_uri_mismatch

This error occurs when the redirect URI in your Google OAuth Console doesn't match what Laravel is sending.

## How to Fix:

### Step 1: Find Your Application URL

Your application URL depends on your setup:

**For Laragon (Windows):**
- Usually: `http://inventory.test` or `http://localhost/inventory`
- Or: `http://127.0.0.1:8000` if using `php artisan serve`

**To check your current APP_URL:**
1. Check your `.env` file for `APP_URL`
2. Or run: `php artisan tinker` then `config('app.url')`

### Step 2: Determine the Exact Redirect URI

Your redirect URI should be:
```
{APP_URL}/auth/google/callback
```

**Examples:**
- `http://inventory.test/auth/google/callback`
- `http://localhost:8000/auth/google/callback`
- `http://127.0.0.1/inventory/auth/google/callback`

### Step 3: Add Redirect URI to Google Console

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Select your project (or create one)
3. Go to **APIs & Services** > **Credentials**
4. Click on your OAuth 2.0 Client ID (or create one)
5. Under **Authorized redirect URIs**, click **ADD URI**
6. Add your exact redirect URI (e.g., `http://inventory.test/auth/google/callback`)
7. **Important:** 
   - Use `http://` for local development (not `https://`)
   - No trailing slash
   - Must match exactly (case-sensitive)
   - You can add multiple URIs for different environments

### Step 4: Update Your .env File (Optional)

If you want to set a custom redirect URI, add to your `.env`:

```env
APP_URL=http://inventory.test
GOOGLE_REDIRECT_URI=http://inventory.test/auth/google/callback
```

### Step 5: Clear Config Cache

After making changes, run:
```bash
php artisan config:clear
```

### Common Issues:

1. **Using https:// instead of http://** for local development
   - Solution: Use `http://` for localhost

2. **Trailing slash**
   - Wrong: `http://inventory.test/auth/google/callback/`
   - Correct: `http://inventory.test/auth/google/callback`

3. **Port mismatch**
   - If using `php artisan serve`, make sure port matches (usually 8000)
   - Example: `http://localhost:8000/auth/google/callback`

4. **Multiple redirect URIs needed**
   - You can add multiple URIs in Google Console for:
     - Local development: `http://localhost:8000/auth/google/callback`
     - Production: `https://yourdomain.com/auth/google/callback`

### Testing:

After adding the redirect URI, try logging in again. The error should be resolved.

