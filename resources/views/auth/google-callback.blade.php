<!DOCTYPE html>
<html>
<head>
    <title>Processing...</title>
    {{-- Anda bisa menambahkan style untuk loading spinner di sini --}}
</head>
<body>
    <h1>Memproses login Anda...</h1>

    <script>
        const authCode = @json($code);

        if (authCode) {
            fetch('/api/auth/google/callback', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ code: authCode })
            })
            .then(response => response.json())
            .then(data => {
                if (data.access_token) {
                    localStorage.setItem('api_token', data.access_token);
                    localStorage.setItem('user_data', JSON.stringify(data.user));
                    window.location.href = '/'; // Arahkan ke halaman utama setelah sukses
                } else {
                    alert('Login Gagal: ' + (data.error || 'Terjadi kesalahan di server.'));
                    window.location.href = '/login';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                window.location.href = '/login';
            });
        } else {
             window.location.href = '/login';
        }
    </script>
</body>
</html>