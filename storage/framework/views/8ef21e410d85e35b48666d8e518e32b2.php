

<?php $__env->startSection('title', 'Edit Profile'); ?>

<?php $__env->startSection('page-title', 'Edit Profile'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

<style>
  .profile-wrap *, .profile-wrap *::before, .profile-wrap *::after { box-sizing: border-box; }

  .profile-wrap {
    --bg-card:        #FFFFFF;
    --bg-muted:       #F1EFE8;
    --text-primary:   #1A1A18;
    --text-secondary: #5F5E5A;
    --text-muted:     #888780;
    --border:         rgba(0,0,0,.08);
    --border-strong:  rgba(0,0,0,.14);
    --radius-md:      8px;
    --radius-lg:      12px;
    --blue-bg:        #E6F1FB;
    --blue-text:      #0C447C;
    --blue-mid:       #185FA5;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    padding: 1.5rem 0;
  }

  .profile-wrap .page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
  .profile-wrap .page-header h1 { font-size: 20px !important; font-weight: 500 !important; color: var(--text-primary) !important; margin: 0 !important; }
  .profile-wrap .page-header p  { font-size: 13px !important; color: var(--text-secondary) !important; margin: 4px 0 0 !important; }

  .profile-wrap .panel {
    background: var(--bg-card) !important;
    border: 0.5px solid var(--border) !important;
    border-radius: var(--radius-lg) !important;
    padding: 1.25rem !important;
    box-shadow: none !important;
  }
  .profile-wrap .panel-head  { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1.25rem; }
  .profile-wrap .panel-title { font-size: 14px !important; font-weight: 500 !important; color: var(--text-primary) !important; }
  .profile-wrap .panel-sub   { font-size: 12px !important; color: var(--text-muted) !important; margin-top: 2px !important; }

  .profile-wrap .section-label {
    font-size: 12px !important;
    font-weight: 500 !important;
    color: var(--text-muted) !important;
    text-transform: uppercase !important;
    letter-spacing: .05em !important;
    display: flex !important;
    align-items: center !important;
    gap: 6px !important;
    padding-bottom: 10px !important;
    margin-bottom: 1rem !important;
    border-bottom: 0.5px solid var(--border) !important;
  }
  .profile-wrap .section-label i { font-size: 14px !important; }

  .profile-wrap .form-grid-2 { display: grid !important; grid-template-columns: 1fr 1fr !important; gap: 12px !important; }
  @media (max-width: 580px) { .profile-wrap .form-grid-2 { grid-template-columns: 1fr !important; } }

  .profile-wrap .field { display: flex !important; flex-direction: column !important; gap: 5px !important; }
  .profile-wrap .field label {
    font-size: 12px !important;
    font-weight: 500 !important;
    color: var(--text-secondary) !important;
    margin-bottom: 0 !important;
  }

  .profile-wrap .field input,
  .profile-wrap .field select,
  .profile-wrap .field textarea {
    font-size: 13px !important;
    color: var(--text-primary) !important;
    background: var(--bg-card) !important;
    border: 0.5px solid var(--border-strong) !important;
    border-radius: var(--radius-md) !important;
    padding: 8px 12px !important;
    outline: none !important;
    transition: border-color .15s !important;
    width: 100% !important;
    box-shadow: none !important;
    appearance: auto !important;
    -webkit-appearance: auto !important;
    height: auto !important;
  }
  .profile-wrap .field input:focus,
  .profile-wrap .field select:focus,
  .profile-wrap .field textarea:focus {
    border-color: var(--blue-mid) !important;
    box-shadow: none !important;
  }
  .profile-wrap .field textarea { resize: vertical !important; min-height: 80px !important; }
  .profile-wrap .field input.is-invalid,
  .profile-wrap .field select.is-invalid,
  .profile-wrap .field textarea.is-invalid { border-color: #E24B4A !important; }
  .profile-wrap .invalid-feedback { font-size: 12px !important; color: #791F1F !important; margin-top: 3px !important; display: block !important; }

  .profile-wrap .avatar-row { display: flex !important; align-items: center !important; gap: 16px !important; }
  .profile-wrap .avatar-circle {
    width: 64px !important; height: 64px !important; border-radius: 50% !important;
    background: var(--blue-bg) !important; color: var(--blue-text) !important;
    display: flex !important; align-items: center !important; justify-content: center !important;
    font-size: 22px !important; font-weight: 500 !important; flex-shrink: 0 !important;
    overflow: hidden !important;
  }
  .profile-wrap .avatar-circle img { width: 100% !important; height: 100% !important; object-fit: cover !important; }

  .profile-wrap .divider { border: none !important; border-top: 0.5px solid var(--border) !important; margin: 1.25rem 0 !important; }

  .profile-wrap .pf-btn {
    display: inline-flex !important; align-items: center !important; gap: 6px !important;
    font-size: 13px !important; font-weight: 500 !important; padding: 8px 16px !important;
    border-radius: var(--radius-md) !important; border: 0.5px solid var(--border-strong) !important;
    background: var(--bg-card) !important; color: var(--text-primary) !important;
    cursor: pointer !important; transition: background .15s !important; text-decoration: none !important;
    box-shadow: none !important;
  }
  .profile-wrap .pf-btn:hover       { background: var(--bg-muted) !important; }
  .profile-wrap .pf-btn.pf-primary   { background: var(--blue-mid) !important; border-color: var(--blue-mid) !important; color: #fff !important; }
  .profile-wrap .pf-btn.pf-primary:hover { background: var(--blue-text) !important; }
</style>

<div class="profile-wrap">

  <div class="page-header">
    <div>
      <h1>Edit profile</h1>
      <p>Update your personal details, password, and avatar.</p>
    </div>
  </div>

  <div class="panel">
    <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>

      <div class="panel-head">
        <div>
          <div class="panel-title">Profile information</div>
          <div class="panel-sub">Manage your account details</div>
        </div>
      </div>

      <div class="section-label">
        <i class="ti ti-user-circle" aria-hidden="true"></i> Personal details
      </div>

      <div class="form-grid-2" style="margin-bottom:12px">
        <div class="field">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
          <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="field">
          <label for="email">Email address</label>
          <input type="email" id="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
      </div>

      <div class="form-grid-2" style="margin-bottom:12px">
        <div class="field">
          <label for="contact">Contact number</label>
          <input type="text" id="contact" name="contact" value="<?php echo e(old('contact', $user->contact)); ?>" class="<?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
          <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="field">
          <label for="gender">Gender</label>
          <select id="gender" name="gender" class="<?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <option value="">Select gender</option>
            <option value="Male"   <?php echo e(old('gender', $user->gender) == 'Male'   ? 'selected' : ''); ?>>Male</option>
            <option value="Female" <?php echo e(old('gender', $user->gender) == 'Female' ? 'selected' : ''); ?>>Female</option>
            <option value="Other"  <?php echo e(old('gender', $user->gender) == 'Other'  ? 'selected' : ''); ?>>Other</option>
          </select>
          <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
      </div>

      <div class="field" style="margin-bottom:4px">
        <label for="address">Address</label>
        <textarea id="address" name="address" class="<?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('address', $user->address)); ?></textarea>
        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <hr class="divider">

      <div class="section-label">
        <i class="ti ti-lock" aria-hidden="true"></i> Change password
      </div>

      <div class="form-grid-2" style="margin-bottom:4px">
        <div class="field">
          <label for="password">New password</label>
          <input type="password" id="password" name="password" class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="field">
          <label for="password_confirmation">Confirm new password</label>
          <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
      </div>

      <hr class="divider">

      <div class="section-label">
        <i class="ti ti-photo" aria-hidden="true"></i> Profile picture
      </div>

      <div class="avatar-row" style="margin-bottom:12px">
        <div class="avatar-circle" id="avatar-preview-wrap">
          <?php if($user->avatar): ?>
            <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" alt="Current avatar" id="avatar-preview">
          <?php else: ?>
            <i class="ti ti-user" style="font-size:26px" aria-hidden="true"></i>
          <?php endif; ?>
        </div>
        <div class="field" style="flex:1">
          <label for="avatar">Upload avatar</label>
          <input type="file" id="avatar" name="avatar" accept="image/*" class="<?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
          <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
      </div>

      <div style="display:flex;justify-content:flex-end;padding-top:8px">
        <button type="submit" class="pf-btn pf-primary">
          <i class="ti ti-check" aria-hidden="true"></i> Update profile
        </button>
      </div>

    </form>
  </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  document.getElementById('avatar').addEventListener('change', function(e) {
    const [file] = e.target.files;
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => {
      const wrap = document.getElementById('avatar-preview-wrap');
      wrap.innerHTML = '';
      const img = document.createElement('img');
      img.src = ev.target.result;
      img.alt = 'Avatar preview';
      wrap.appendChild(img);
    };
    reader.readAsDataURL(file);
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ClassSchedule\resources\views/profile/edit.blade.php ENDPATH**/ ?>