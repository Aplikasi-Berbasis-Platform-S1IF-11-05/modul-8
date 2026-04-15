function createCell(content, className) {
  const cell = document.createElement("td");
  cell.textContent = content;
  if (className) {
    cell.className = className;
  }
  return cell;
}

async function loadDataMahasiswa() {
  const body = document.getElementById("table-body");
  const rataRata = document.getElementById("rata-rata");
  const nilaiTertinggi = document.getElementById("nilai-tertinggi");
  const pemilikTertinggi = document.getElementById("pemilik-tertinggi");
  const errorMessage = document.getElementById("error-message");

  try {
    const response = await fetch("data.php", { cache: "no-store" });
    if (!response.ok) {
      throw new Error("Gagal memuat data dari server.");
    }

    const result = await response.json();
    const mahasiswa = Array.isArray(result.mahasiswa) ? result.mahasiswa : [];
    const ringkasan = result.ringkasan || {};

    body.innerHTML = "";

    if (mahasiswa.length === 0) {
      const row = document.createElement("tr");
      row.appendChild(createCell("Data mahasiswa belum tersedia.", ""));
      row.firstChild.colSpan = 9;
      body.appendChild(row);
    } else {
      mahasiswa.forEach((item, index) => {
        const row = document.createElement("tr");
        row.appendChild(createCell(String(index + 1)));
        row.appendChild(createCell(String(item.nama || "-")));
        row.appendChild(createCell(String(item.nim || "-")));
        row.appendChild(createCell(String(item.nilai_tugas ?? "-")));
        row.appendChild(createCell(String(item.nilai_uts ?? "-")));
        row.appendChild(createCell(String(item.nilai_uas ?? "-")));
        row.appendChild(createCell(Number(item.nilai_akhir || 0).toFixed(2)));
        row.appendChild(createCell(String(item.grade || "-")));

        const statusText = String(item.status || "-");
        const statusClass =
          statusText === "Lulus" ? "status-pass" : "status-fail";
        row.appendChild(createCell(statusText, statusClass));

        body.appendChild(row);
      });
    }

    rataRata.textContent = Number(ringkasan.rata_rata_kelas || 0).toFixed(2);

    const tertinggi = ringkasan.nilai_tertinggi || {};
    nilaiTertinggi.textContent = Number(tertinggi.nilai || 0).toFixed(2);
    pemilikTertinggi.textContent = `${tertinggi.nama || "-"} (${tertinggi.nim || "-"})`;
    errorMessage.hidden = true;
    errorMessage.textContent = "";
  } catch (error) {
    body.innerHTML = "";
    const row = document.createElement("tr");
    row.appendChild(createCell("Tidak dapat memuat data mahasiswa.", ""));
    row.firstChild.colSpan = 9;
    body.appendChild(row);

    errorMessage.hidden = false;
    errorMessage.textContent =
      error instanceof Error ? error.message : "Terjadi kesalahan.";
  }
}

loadDataMahasiswa();
