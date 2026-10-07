/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// Menu dinamis
let current_url = window.location.href;
$('ul.sidebar-menu li a').each(function() {
    if (this.href === current_url || (this.href !== '#' && current_url.indexOf(this.href) === 0)) {
        $(this).parent().addClass('active');
        $(this).closest('li.dropdown').addClass('active');
    }
});

// Pagination / DataTables
$(document).ready(function() {
    if ($('#myTable').length > 0) {
        $('#myTable').DataTable();
    }
});

// Modern Delete Confirmation via SweetAlert
function hapus(id) {
    if (typeof swal !== 'undefined') {
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Data yang dihapus tidak dapat dipulihkan kembali!',
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Batal',
                    value: null,
                    visible: true,
                    className: 'btn btn-secondary',
                    closeModal: true,
                },
                confirm: {
                    text: 'Ya, Hapus!',
                    value: true,
                    visible: true,
                    className: 'btn btn-danger',
                    closeModal: true
                }
            },
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $('#del-' + id).submit();
            }
        });
    } else {
        if (confirm('Yakin ingin menghapus data ini?')) {
            $('#del-' + id).submit();
        }
    }
}

// AntiSlopUI Number Ticker with easeOutExpo
function animateCounters() {
    $('.count-up').each(function() {
        let $this = $(this);
        let target = parseFloat($this.attr('data-target')) || 0;
        let prefix = $this.attr('data-prefix') || '';
        let suffix = $this.attr('data-suffix') || '';
        let duration = 1200;
        let startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            let progress = Math.min((timestamp - startTime) / duration, 1);
            let ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
            let current = Math.floor(target * ease);
            $this.text(prefix + current.toLocaleString('id-ID') + suffix);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                $this.text(prefix + target.toLocaleString('id-ID') + suffix);
            }
        }
        window.requestAnimationFrame(step);
    });
}

// Trigger animations & global keybindings on load
$(document).ready(function() {
    animateCounters();
    initLumoraAtmosphere();

    // Quick Search shortcut: Ctrl + K or Cmd + K
    $(document).on('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            let searchInput = $('input[type="search"]:first, .search-element input:first');
            if (searchInput.length) {
                searchInput.focus().select();
            }
        }
    });
});

// ==========================================
// LUMORA STUDIO - ATMOSPHERIC AMBIENT CANVAS
// ==========================================
function initLumoraAtmosphere() {
    const canvas = document.getElementById('lumoraAtmosphereCanvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let width = canvas.width = window.innerWidth;
    let height = canvas.height = window.innerHeight;

    window.addEventListener('resize', () => {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
    });

    const orbs = [
        { x: width * 0.25, y: height * 0.2, r: 380, color: 'rgba(39, 137, 216, 0.12)', vx: 0.25, vy: 0.18 },
        { x: width * 0.8, y: height * 0.35, r: 420, color: 'rgba(80, 176, 255, 0.09)', vx: -0.2, vy: 0.22 },
        { x: width * 0.45, y: height * 0.8, r: 350, color: 'rgba(191, 234, 255, 0.06)', vx: 0.15, vy: -0.15 }
    ];

    function draw() {
        ctx.clearRect(0, 0, width, height);

        for (let i = 0; i < orbs.length; i++) {
            let orb = orbs[i];
            orb.x += orb.vx;
            orb.y += orb.vy;

            if (orb.x < -150 || orb.x > width + 150) orb.vx *= -1;
            if (orb.y < -150 || orb.y > height + 150) orb.vy *= -1;

            const grad = ctx.createRadialGradient(orb.x, orb.y, 0, orb.x, orb.y, orb.r);
            grad.addColorStop(0, orb.color);
            grad.addColorStop(1, 'rgba(28, 28, 29, 0)');

            ctx.fillStyle = grad;
            ctx.beginPath();
            ctx.arc(orb.x, orb.y, orb.r, 0, Math.PI * 2);
            ctx.fill();
        }

        requestAnimationFrame(draw);
    }
    requestAnimationFrame(draw);
}


// ==========================================
// TRANSAKSI - DYNAMIC TABLE (Video #11)
// ==========================================

function barisBaru() {
    $(document).ready(function() {
        $("[data-toggle='tooltip']").tooltip();
    });
    let Nomor = $("#tableLoop tbody tr").length + 1;
    let Baris = '<tr>';
    Baris += '<td class="text-center">' + Nomor + '</td>';
    Baris += '<td>';
    Baris += '<select class="form-control" name="kode_akun3[]" id="kode_akun3' + Nomor + '" required>';
    Baris += '<option value="" hidden>-- Pilih Akun --</option>';
    Baris += '</select>';
    Baris += '</td>';
    Baris += '<td>';
    Baris += '<input type="number" name="debit[]" class="form-control" value="0" required>';
    Baris += '</td>';
    Baris += '<td>';
    Baris += '<input type="number" name="kredit[]" class="form-control" value="0" required>';
    Baris += '</td>';
    Baris += '<td>';
    Baris += '<select class="form-control" name="id_status[]" id="id_status' + Nomor + '" required>';
    Baris += '<option value="" hidden>-- Pilih Status --</option>';
    Baris += '</select>';
    Baris += '</td>';
    Baris += '<td class="text-center">';
    Baris += '<button type="button" class="btn btn-danger btn-sm hapusBaris" title="Hapus Baris"><i class="fa fa-trash"></i></button>';
    Baris += '</td>';
    Baris += '</tr>';

    $("#tableLoop tbody").append(Baris);
    $("#tableLoop tbody tr").each(function () {
        $(this).find('td:nth-child(2) input').focus();
    });

    FormSelectAkun(Nomor);
    FormSelectStatus(Nomor);
    setTimeout(updateLedgerBalance, 100);
}

$(document).on('click', '#barisBaru', function(e) {
    e.preventDefault();
    barisBaru();
});

$(document).on('click', '.hapusBaris', function(e) {
    e.preventDefault();
    $(this).closest('tr').remove();
    // Hitung ulang nomor urut
    $('#tableLoop tbody tr').each(function(index) {
        $(this).find('td:first').text(index + 1);
    });
    updateLedgerBalance();
});

function FormSelectAkun(Nomor) {
    let output = [];
    let endpoint = typeof urlAkun3 !== 'undefined' ? urlAkun3 : (window.location.origin + window.location.pathname.replace(/\/transaksi(\/.*)?$/, '/transaksi') + '/akun3');
    $.getJSON(endpoint, function(data) {
        $.each(data, function(key, val) {
            output.push('<option value="' + val.kode_akun3 + '">' + val.kode_akun3 + ' - ' + val.nama_akun3 + '</option>');
        });
        $('#kode_akun3' + Nomor).append(output.join(''));
    });
}

function FormSelectStatus(Nomor) {
    let output = [];
    let endpoint = typeof urlStatus !== 'undefined' ? urlStatus : (window.location.origin + window.location.pathname.replace(/\/transaksi(\/.*)?$/, '/transaksi') + '/status');
    $.getJSON(endpoint, function(data) {
        $.each(data, function(key, val) {
            output.push('<option value="' + val.id_status + '">' + val.status + '</option>');
        });
        $('#id_status' + Nomor).append(output.join(''));
    });
}

// ==========================================
// REAL-TIME LEDGER BALANCING ENGINE (SIA Spec)
// ==========================================
function updateLedgerBalance() {
    let totalDebit = 0;
    let totalKredit = 0;

    $('#tableLoop tbody tr').each(function() {
        let deb = parseFloat($(this).find('input[name="debit[]"]').val()) || 0;
        let kre = parseFloat($(this).find('input[name="kredit[]"]').val()) || 0;
        totalDebit += deb;
        totalKredit += kre;
    });

    let delta = Math.abs(totalDebit - totalKredit);
    let isBalanced = (totalDebit > 0 && totalDebit === totalKredit);

    if ($('#liveDebitTotal').length) {
        $('#liveDebitTotal').text('Rp ' + totalDebit.toLocaleString('id-ID'));
    }
    if ($('#liveKreditTotal').length) {
        $('#liveKreditTotal').text('Rp ' + totalKredit.toLocaleString('id-ID'));
    }
    if ($('#liveDeltaTotal').length) {
        $('#liveDeltaTotal').text('Rp ' + delta.toLocaleString('id-ID'));
    }

    let pill = $('#liveBalancePill');
    let submitBtn = $('#submitTransaksiBtn');

    if (pill.length) {
        if (isBalanced) {
            pill.removeClass('unbalanced').addClass('balanced');
            pill.html('<i class="fas fa-check-circle mr-1"></i> SEIMBANG (BALANCE)');
            $('#balanceWarningAlert').slideUp(200);
            if (submitBtn.length) {
                submitBtn.removeAttr('disabled').removeClass('disabled').css('opacity', '1');
            }
        } else {
            pill.removeClass('balanced').addClass('unbalanced');
            let label = (totalDebit === 0 && totalKredit === 0) 
                ? '<i class="fas fa-info-circle mr-1"></i> INPUT NOMINAL DEBIT &amp; KREDIT' 
                : '<i class="fas fa-exclamation-triangle mr-1"></i> TIDAK SEIMBANG (SELISIH: Rp ' + delta.toLocaleString('id-ID') + ')';
            pill.html(label);
            if (totalDebit > 0 || totalKredit > 0) {
                $('#balanceWarningAlert').slideDown(200);
            } else {
                $('#balanceWarningAlert').slideUp(200);
            }
        }
    }
}

$(document).on('input keyup change', '#tableLoop input[name="debit[]"], #tableLoop input[name="kredit[]"]', function() {
    updateLedgerBalance();
});

// ==========================================
// PENYESUAIAN - KALKULASI NILAI/WAKTU (Video #13)
// ==========================================

function hitung() {
    let nilai = parseFloat($('input[name="nilai"]').val()) || 0;
    let waktu = parseFloat($('input[name="waktu"]').val()) || 0;
    let jumlah = waktu > 0 ? (nilai / waktu) : 0;
    $('input[name="jumlah"]').val(Math.round(jumlah));
}

// Auto generate 2 baris transaksi saat halaman dibuka (hanya jika tabel masih kosong, misal di form new)
$(document).ready(function() {
    if ($('#tableLoop').length > 0) {
        if ($('#tableLoop tbody tr').length === 0) {
            barisBaru();
            barisBaru();
        }
        setTimeout(updateLedgerBalance, 300);
    }
});


