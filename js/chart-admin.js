document.addEventListener("DOMContentLoaded", () => {

    // Ambil data dari element HTML yang menyimpan JSON
    const pesanan = JSON.parse(document.getElementById("dataPesanan").value);
    const pendapatan = JSON.parse(document.getElementById("dataPendapatan").value);

    // Chart Pesanan
    const ctxPesanan = document.getElementById("chartPesanan");
    new Chart(ctxPesanan, {
        type: "bar",
        data: {
            labels: pesanan.map(i => "Bulan " + i.bulan),
            datasets: [{
                label: "Jumlah Pesanan",
                data: pesanan.map(i => i.total),
                backgroundColor: "rgba(0, 129, 72, 0.7)",
                borderRadius: 10
            }]
        }
    });

    // Chart Pendapatan
    const ctxPendapatan = document.getElementById("chartPendapatan");
    new Chart(ctxPendapatan, {
        type: "line",
        data: {
            labels: pendapatan.map(i => "Bulan " + i.bulan),
            datasets: [{
                label: "Pendapatan",
                data: pendapatan.map(i => i.total),
                borderColor: "#1e3932",
                borderWidth: 3,
                tension: 0.3
            }]
        }
    });
    

});
