# Google OAuth Console Setup - Step by Step

## Current Configuration
- **Laravel Redirect URI:** `http://127.0.0.1:8000/auth/google/callback`
- **Client ID:** `785199507806-jbsapl5pua7frahaeubnuj9g3qajc8c6.apps.googleusercontent.com`

## Step-by-Step Instructions

### Step 1: Go to Google Cloud Console
1. Open: https://console.cloud.google.com/
2. Make sure you're logged in with the correct Google account
3. Select the project that contains your OAuth credentials

### Step 2: Navigate to Credentials
1. Click on **"APIs & Services"** in the left sidebar
2. Click on **"Credentials"** (or go directly: https://console.cloud.google.com/apis/credentials)

### Step 3: Find Your OAuth 2.0 Client
1. Look for the OAuth 2.0 Client ID that matches: `785199507806-jbsapl5pua7frahaeubnuj9g3qajc8c6`
2. **IMPORTANT:** Make sure you're editing the correct client ID
3. Click on the **pencil icon** (Edit) next to your OAuth client

### Step 4: Add Authorized Redirect URIs
1. Scroll down to **"Authorized redirect URIs"** section
2. Click **"+ ADD URI"** button
3. **EXACTLY** type this (copy-paste to avoid typos):
   ```
   http://127.0.0.1:8000/auth/google/callback
   ```
4. **IMPORTANT CHECKS:**
   - ✅ No trailing slash at the end
   - ✅ Use `http://` not `https://`
   - ✅ Use `127.0.0.1` not `localhost`
   - ✅ Include the port `:8000`
   - ✅ No extra spaces before or after

### Step 5: Add Additional URIs (Recommended)
For flexibility, also add these:
- `http://localhost:8000/auth/google/callback`
- `http://127.0.0.1/auth/google/callback` (if using Laragon without port)
- `http://inventory.test/auth/google/callback` (if using Laragon virtual host)

### Step 6: Save Changes
1. Click **"SAVE"** button at the bottom
2. Wait for the confirmation message
3. **IMPORTANT:** Changes may take a few minutes to propagate

### Step 7: Verify OAuth Consent Screen
1. Go to **"OAuth consent screen"** in the left sidebar
2. Make sure:
   - User Type is set (Internal or External)
   - App name is filled
   - Support email is set
   - At least one test user is added (if using Internal)

### Step 8: Test Again
1. Wait 2-3 minutes for changes to propagate
2. Clear your browser cache/cookies
3. Try logging in again

## Common Mistakes to Avoid

❌ **WRONG:**
- `http://127.0.0.1:8000/auth/google/callback/` (trailing slash)
- `https://127.0.0.1:8000/auth/google/callback` (using https)
- `http://localhost:8000/auth/google/callback` (localhost instead of 127.0.0.1)
- `http://127.0.0.1:8000/auth/google/callback ` (trailing space)
- ` http://127.0.0.1:8000/auth/google/callback` (leading space)

✅ **CORRECT:**
- `http://127.0.0.1:8000/auth/google/callback`

## If Still Not Working

1. **Check you're editing the correct OAuth client:**
   - The Client ID must match: `785199507806-jbsapl5pua7frahaeubnuj9g3qajc8c6`
   - If you have multiple OAuth clients, make sure you're editing the right one

2. **Verify the redirect URI is saved:**
   - After saving, check that the URI appears in the list
   - Make sure there are no extra characters

3. **Wait for propagation:**
   - Google changes can take 5-10 minutes to fully propagate
   - Try again after waiting

4. **Check OAuth consent screen:**
   - Make sure the app is properly configured
   - If using "Internal", add your email as a test user

5. **Try creating a new OAuth client:**
   - Sometimes it's easier to create a fresh OAuth client
   - Copy the new Client ID and Secret to your `.env` file

## Alternative: Use localhost instead

If `127.0.0.1` keeps causing issues, you can switch to `localhost`:

1. Update your `.env`:
   ```env
   APP_URL=http://localhost:8000
   ```

2. Add to Google Console:
   ```
   http://localhost:8000/auth/google/callback
   ```

3. Clear config cache:
   ```bash
   php artisan config:clear
   ```

