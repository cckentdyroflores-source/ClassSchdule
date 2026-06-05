

<?php $__env->startSection('title', 'Users'); ?>
<?php $__env->startSection('page-title', 'Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div>
        <div class="page-title">Users</div>
        <div class="page-sub">Manage system users and their access</div>
    </div>
    <button class="btn-accent" onclick="openModal('modal-user')">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" width="16" height="16">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Add User
    </button>
</div>

<form method="GET" action="<?php echo e(route('users.index')); ?>" class="filter-bar">
    <input type="text" name="search" placeholder="Search users..." value="<?php echo e(request('search')); ?>" style="width:220px;">
    <button type="submit" class="btn-accent">Search</button>
</form>

<div class="card-panel" style="padding:0;">
    <div style="overflow-x:auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--text-muted)"><?php echo e($i + 1); ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:.75rem;">
                            <div class="user-avatar" style="width:34px;height:34px;font-size:.8rem;"><?php echo e($u->initials); ?></div>
                            <strong><?php echo e($u->name); ?></strong>
                        </div>
                    </td>
                    <td style="color:var(--text-muted)"><?php echo e($u->email); ?></td>
                    <td><span class="status-badge active"><?php echo e($u->role); ?></span></td>
                    <td style="color:var(--text-muted)"><?php echo e($u->created_at->format('Y-m-d')); ?></td>
                    <td>
                        <button class="btn-sm-icon"
                            onclick="openEditUser(<?php echo e($u->id); ?>, '<?php echo e(addslashes($u->name)); ?>', '<?php echo e(addslashes($u->email)); ?>')">
                            ✎ Edit
                        </button>
                        <?php if($u->id !== auth()->id()): ?>
                        <form method="POST" action="<?php echo e(route('users.destroy', $u)); ?>" style="display:inline;" onsubmit="return confirm('Delete this user?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-sm-icon danger" style="margin-left:4px;">✕ Delete</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6"><div class="empty-state">No users found.</div></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal-overlay" id="modal-user">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-title" id="user-modal-title">Add User</div>
            <button type="button" class="modal-close" onclick="closeModal('modal-user')">✕</button>
        </div>

        
        <form
            method="POST"
            id="user-form"
            action="<?php echo e(route('users.store')); ?>"
>
    <?php echo csrf_field(); ?>
            <span id="user-method-field"></span>
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" id="u-name" placeholder="Juan dela Cruz" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" id="u-email" placeholder="juan@university.edu" required>
            </div>
            <div class="form-group" id="u-pass-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Min. 8 characters">
            </div>
            <div style="display:flex;gap:.75rem;justify-content:flex-end;margin-top:1.5rem;">
                <button type="button" class="btn-outline" onclick="closeModal('modal-user')">Cancel</button>
                <button type="submit" class="btn-accent">Save User</button>
            </div>
        </form>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function openEditUser(id, name, email) {
    var form = document.getElementById('user-form');
    form.action = '/users/' + id;
    document.getElementById('user-method-field').innerHTML = '<input type="hidden" name="_method" value="PUT">';
    document.getElementById('user-modal-title').textContent = 'Edit User';
    document.getElementById('u-name').value = name;
    document.getElementById('u-email').value = email;
    document.getElementById('u-pass-group').style.display = 'none';
    openModal('modal-user');
}

document.querySelector('[onclick="openModal(\'modal-user\')"]').addEventListener('click', function () {
    var form = document.getElementById('user-form');
    form.action = '<?php echo e(route('users.store')); ?>';
    document.getElementById('user-method-field').innerHTML = '';
    document.getElementById('user-modal-title').textContent = 'Add User';
    document.getElementById('u-name').value = '';
    document.getElementById('u-email').value = '';
    document.getElementById('u-pass-group').style.display = 'block';
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ClassSchedule\resources\views/users/index.blade.php ENDPATH**/ ?>