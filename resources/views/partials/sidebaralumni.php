<aside class="sidebar">
    <div class="sidebar-header">
        <p class="sidebar-portal-name">Alumni Portal</p>
        <p class="sidebar-portal-badge">Verified Member</p>
    </div>
    
    <div class="sidebar-nav">
        <div class="nav-group">
            <div class="sidebar-nav-item" style="color: var(--color-primary); font-weight: 600;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Manajemen Profil
            </div>
            
            <div class="sidebar-submenu">
                <a href="/pendidikan" class="submenu-item">Riwayat Pendidikan</a>
                
                <a href="/pengalaman-kerja" class="submenu-item active">Pengalaman Kerja</a>
                
                <a href="/pencapaian" class="submenu-item">Pencapaian</a>
                <a href="/sertifikasi" class="submenu-item">Sertifikasi</a>
            </div>
        </div>

        <a href="/manajemen-akun" class="sidebar-nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Manajemen Akun
        </a>
    </div>
    
    <div class="sidebar-bottom">
        <button class="logout-button" type="button" onclick="handleLogout()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Log Out
        </button>
    </div>
</aside>

<script>
    function handleLogout() {
        if (confirm('Yakin ingin keluar?')) { 
            console.log('Logout dipicu'); 
        }
    }
</script>