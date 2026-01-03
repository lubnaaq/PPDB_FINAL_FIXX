# ✅ POST-INSTALLATION CHECKLIST

## 📋 Sebelum Go-Live

### Database & Migration
- [ ] Jalankan `php artisan migrate`
- [ ] Verifikasi tabel dokumens terbuat di database
- [ ] Check kolom dan relationships

### Autoload & Composer
- [ ] Jalankan `composer dump-autoload`
- [ ] Test formatBytes() helper function
- [ ] Verifikasi tidak ada error di browser

### Storage Setup
- [ ] Jalankan `php artisan storage:link` (jika belum ada)
- [ ] Cek folder `storage/app/public/dokumen` exist
- [ ] Set permissions: `chmod -R 775 storage/app/public`
- [ ] Test upload file

### Controllers & Routes
- [ ] Verify semua controllers terload
- [ ] Test routes dengan `php artisan route:list`
- [ ] Filter untuk dokumen routes

### Views
- [ ] Check user dokumen view render
- [ ] Check admin verifikasi view render
- [ ] Test form submission

### User Role Testing
- [ ] Create test user account
- [ ] Create test admin account
- [ ] Login sebagai user, test upload flow
- [ ] Login sebagai admin, test verification flow

---

## 🚀 Upload & Download Testing

### Upload Testing
- [ ] Upload valid PDF (< 5MB)
- [ ] Upload valid JPG (< 5MB)
- [ ] Upload valid PNG (< 5MB)
- [ ] Try upload file > 5MB (should fail)
- [ ] Try upload .txt file (should fail)
- [ ] Try upload .docx file (should fail)
- [ ] Test empty file upload (should fail)
- [ ] Test required field validation

### File Management
- [ ] Upload sama dokumen 2x (should work)
- [ ] Verify document list terorder by date
- [ ] Verify file size formatting (B, KB, MB)
- [ ] Test download functionality
- [ ] Test delete pending document
- [ ] Verify cannot delete non-pending document

---

## 👤 User Flow Testing

### Senario 1: Complete Upload Flow
1. [ ] Login sebagai user
2. [ ] Navigate ke /dokumen
3. [ ] Lihat form upload
4. [ ] Select dokumen type
5. [ ] Select file
6. [ ] Click upload
7. [ ] Verify success message
8. [ ] Verify document appear in list
9. [ ] Status should be "Pending"

### Senario 2: Download Document
1. [ ] Upload document
2. [ ] Click download button
3. [ ] File should download correctly
4. [ ] Verify file content

### Senario 3: Delete Document
1. [ ] Upload document (status pending)
2. [ ] Click delete button
3. [ ] Confirm deletion
4. [ ] Document should removed from list
5. [ ] Soft delete verify in database

### Senario 4: Multi Upload
1. [ ] Upload 5 different document types
2. [ ] Verify all appear in list
3. [ ] Verify pagination if > 15 items

---

## 👨‍💼 Admin Flow Testing

### Senario 1: View All Documents
1. [ ] Login sebagai admin
2. [ ] Navigate ke /verifikasi
3. [ ] Should see list of all documents
4. [ ] Should show user name, dokumen type, status

### Senario 2: Filter by Status
1. [ ] Click "Semua" - should show all
2. [ ] Click "Menunggu Verifikasi" - filter works
3. [ ] Click "Disetujui" - show only approved
4. [ ] Click "Ditolak" - show only rejected

### Senario 3: Approve Document
1. [ ] Click document row
2. [ ] View document details
3. [ ] Click "Setujui"
4. [ ] Status should change to "Disetujui"
5. [ ] Verify in database

### Senario 4: Reject Document
1. [ ] Click document row
2. [ ] Click "Tolak"
3. [ ] Add rejection note
4. [ ] Submit
5. [ ] Status should change to "Ditolak"
6. [ ] Note should be saved

---

## 🔐 Security Testing

### Authorization
- [ ] User cannot access /verifikasi (admin only)
- [ ] Admin cannot access /dokumen form (user only)
- [ ] User cannot delete other user's document
- [ ] User cannot download other user's document

### CSRF Protection
- [ ] Submit form without CSRF token (should fail)
- [ ] Verify CSRF token in form

### File Security
- [ ] Uploaded files cannot be executed
- [ ] File path contains random timestamp
- [ ] File not accessible directly via URL

### Input Validation
- [ ] XSS attempt in nama_dokumen (should escape)
- [ ] SQL injection attempt (ORM prevents)
- [ ] Invalid file type selected

---

## 📊 Database Verification

### Tabel Dokumens
```sql
SELECT * FROM dokumens LIMIT 1;
SELECT COUNT(*) FROM dokumens;
SELECT * FROM dokumens WHERE status_verifikasi='pending';
```

### Relationships
- [ ] dokumens.user_id correctly references users.id
- [ ] Deleting user cascades to dokumens
- [ ] Soft delete working (deleted_at timestamp)

---

## 📱 UI/UX Verification

### User View
- [ ] Form labels clear
- [ ] Error messages helpful
- [ ] Success messages clear
- [ ] Table responsive on mobile
- [ ] Download/delete buttons visible
- [ ] Modal dialogs working

### Admin View
- [ ] Filter buttons working
- [ ] Table showing all columns
- [ ] Status badges colored correctly
- [ ] Action buttons accessible
- [ ] Modals functional

---

## ⚡ Performance Checklist

- [ ] Upload tidak lag
- [ ] List loading cepat
- [ ] Download smooth
- [ ] Delete response cepat
- [ ] No console errors
- [ ] No server errors (check logs)

---

## 📝 Documentation Checklist

- [ ] QUICK_REFERENCE.md reviewed
- [ ] DOKUMEN_UPLOAD_FEATURE.md complete
- [ ] IMPLEMENTATION_SUMMARY.md useful
- [ ] config/dokumen-upload.php understood
- [ ] Routes documented

---

## 🎯 Final Pre-Launch

### Code Quality
- [ ] No console.log leftover
- [ ] No TODO comments unresolved
- [ ] Code properly formatted
- [ ] No syntax errors

### Browser Compatibility
- [ ] Chrome working
- [ ] Firefox working
- [ ] Edge working
- [ ] Mobile browser working

### Logging & Monitoring
- [ ] Storage logs checked
- [ ] Database logs checked
- [ ] Error logs empty

### Backup & Recovery
- [ ] Database backup ready
- [ ] File backup strategy
- [ ] Rollback plan ready

---

## 📞 Known Issues & Workarounds

### Issue: Helper not found
- **Workaround**: `composer dump-autoload`

### Issue: File upload fails
- **Workaround**: Check storage permissions, ensure folder exists

### Issue: CSRF token error
- **Workaround**: Clear browser cache, ensure @csrf in form

### Issue: Download not working
- **Workaround**: Run `php artisan storage:link`

---

## 🎉 Launch Checklist

- [ ] All testing passed
- [ ] No critical bugs
- [ ] Documentation ready
- [ ] Team trained
- [ ] Backup created
- [ ] Monitoring enabled
- [ ] Ready to go live! 🚀

---

**Last Updated**: 3 Januari 2026
**Prepared by**: GitHub Copilot
**Status**: ✅ Ready for Review
