<!-- Layout.svelte -->
<script>
    import {inertia} from "@inertiajs/svelte"
    export let title;
</script>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{title}</title>
</head>

<section id="content">

    <nav>
        <i class='bx bx-menu toggle-sidebar'></i>
        <span class="divider"></span>
        <div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/search-property.png" alt="search-property"/>&ensp;&nbsp;PATIENT RECORDS</div>
        <div class="profile">
            
            <i class="fas fa-chevron-down arrow hover-pointer"></i>
            <ul class="profile-link">
					<li><a href="/UserProfile" use:inertia><i class='bx bx-user-circle icon'></i> Profile</a></li>
					<li><a id="logout-btn" onclick="logout()" style="cursor: pointer;"><i class='bx bx-log-out icon'></i> Logout</a></li>
			</ul>
        </div>
    </nav>
    <section id="sidebar">
        <a href="/" class="brand"><img src="/images/logo.png" alt="logo" /></a>
        <a href="/" class="brand2"><img src="/images/logoend.png" alt="logo" /></a>
        <ul class="side-menu">
            <li><a href="/dasboard" use:inertia><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li><a href="/patients/add" use:inertia> &nbsp;&emsp;<i class="bi bi-plus-circle-fill"></i> &nbsp;&nbsp;&nbsp;&nbsp;&ensp;Add Record</a></li>
            <li><a href="/patients" use:inertia class="active"> &nbsp;&emsp;<i class="bi bi-search"></i> &nbsp;&nbsp;&nbsp;&nbsp;&ensp;View Records</a></li>
        </ul>
    </section>
    <slot />
</section>
