<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ClassSync — Create Account</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Sora:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root { --primary:#1a1f36; --accent:#4f7cff; --accent2:#22d3a5; --surface:#f4f5f8; --card-bg:#ffffff; --sidebar-text:#8b93b8; --text-main:#1a1f36; --text-muted:#6b7280; --border:#e5e7eb; }
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--text-main); }
h1,h2,h3 { font-family: 'Sora', sans-serif; }
.auth-wrap { min-height: 100vh; display: flex; }
.auth-left { width: 420px; background: var(--primary); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 3rem; flex-shrink: 0; }
.auth-left .brand { color: #fff; font-size: 2rem; font-weight: 700; margin-bottom: .5rem; font-family: 'Sora', sans-serif; }
.auth-left .tagline { color: var(--sidebar-text); font-size: .95rem; text-align: center; line-height: 1.6; }
.auth-left .decorative { margin: 2rem 0; display: grid; grid-template-columns: 1fr 1fr; gap: 12px; width: 100%; }
.deco-card { background: rgba(79,124,255,.15); border-radius: 12px; padding: 1rem; color: #fff; }
.deco-card .label { font-size: .75rem; color: var(--sidebar-text); }
.deco-card .val { font-size: 1.4rem; font-weight: 600; font-family: 'Sora', sans-serif; }
.auth-right { flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem; }
.auth-box { background: var(--card-bg); border-radius: 20px; padding: 2.5rem; width: 100%; max-width: 420px; box-shadow: 0 4px 40px rgba(0,0,0,.08); }
.auth-box h2 { font-size: 1.6rem; margin-bottom: .4rem; }
.auth-box .sub { color: var(--text-muted); font-size: .9rem; margin-bottom: 2rem; }
.form-group { margin-bottom: 1rem; }
.form-label { font-size: .85rem; font-weight: 500; color: var(--text-main); margin-bottom: .4rem; display: block; }
.form-control { border: 1.5px solid var(--border); border-radius: 10px; padding: .7rem 1rem; font-size: .9rem; transition: border-color .2s; width: 100%; background: #fff; color: var(--text-main); }
.form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(79,124,255,.15); outline: none; }
.form-control.is-invalid { border-color: #f87171; }
.invalid-feedback { display: block; font-size: .8rem; color: #f87171; margin-top: .3rem; }
.btn-primary-custom { background: var(--accent); color: #fff; border: none; border-radius: 10px; padding: .75rem 1.5rem; font-size: .95rem; font-weight: 500; width: 100%; cursor: pointer; transition: background .2s, transform .1s; }
.btn-primary-custom:hover { background: #3a65e8; }
.btn-primary-custom:active { transform: scale(.98); }
.auth-link { text-align: center; margin-top: 1.5rem; font-size: .875rem; color: var(--text-muted); }
.auth-link a { color: var(--accent); text-decoration: none; font-weight: 500; }
@media (max-width: 768px) { .auth-left { display: none; } }
</style>
</head>
<body>
<div class="auth-wrap">
    <div class="auth-left">
        <div class="brand">Class<span style="color:var(--accent2)">Sync</span></div>
        <p class="tagline">Join ClassSync to organize and manage your class schedules efficiently.</p>
        <div class="decorative">
            <div class="deco-card"><div class="label">Free</div><div class="val">Plan</div></div>
            <div class="deco-card"><div class="label">Unlimited</div><div class="val">Schedules</div></div>
        </div>
    </div>
    <div class="auth-right">
        <div class="auth-box">
            <h2>Create account</h2>
            <p class="sub">Start managing your class schedules today</p>
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" placeholder="Juan dela Cruz" value="<?php echo e(old('name')); ?>" required autofocus>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" placeholder="juan@university.edu" value="<?php echo e(old('email')); ?>" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" placeholder="Min. 8 characters" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repeat password" required>
                </div>
                <button type="submit" class="btn-primary-custom">Create Account</button>
            </form>
            <div class="auth-link">Already have an account? <a href="<?php echo e(route('login')); ?>">Sign in</a></div>
        </div>
    </div>
</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\ClassSchedule\resources\views/auth/register.blade.php ENDPATH**/ ?>