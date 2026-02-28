<div>
    @vite(['resources/js/staff/scanner.js', 'resources/css/app.css'])

    <div class="relative" x-data="{
        cameraId: null,
        cameraScanner: false,
        scannerDevice: false,
        async init() {
    
        },
        async startCameraScanner() {
            this.cameraScanner = true;
            await this.startScanner();
        },
        async startScanner() {
            await Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    this.cameraId = devices[0].id;
                    console.log(this.cameraId);
                }
            }).catch(err => {
                // handle err
            });
    
            const scanner = new Html5Qrcode('reader');
            scanner.start(
                    this.cameraId, {
                        fps: 10, // Optional, frame per seconds for qr code scanning
                        qrbox: { width: 400, height: 150 } // Optional, if you want bounded box UI
                    },
                    (decodedText, decodedResult) => {
                        Livewire.dispatch('verify-ticket', [decodedText]);
                    },
                    (errorMessage) => {
                        // parse error, ignore it.
                    })
                .catch((err) => {
                    console.log('error');
                    // Start failed, handle it.
                });
        }
    }">
        <div class="flex justify-center items-center h-screen gap-2">
            <div class="bg-gray-100 p-10 rounded-xl space-y-5 mx-5">
                <div>
                    <h2>Please Select</h2>
                    <p class="text-sm text-gray-500">In which way you want to verify ticket</p>
                </div>
                <div class="flex gap-2 flex-wrap">
                    <button class="btn h-12 btn-outline" @click="startCameraScanner()"><x-heroicon-o-camera
                            class="h-5 w-5" /> Use Camera</button>
                    <button class="btn btn-outline h-12"><x-hugeicons-bar-code-02 class="h-5 w-5" /> Use Scanner
                        Device</button>
                </div>
            </div>
        </div>
        <div class="h-full w-full bg-[#112117] flex justify-center items-center">
            <div class="w-full" x-data="{
                buffer: '',
                lastTime: 0,
                init() {
                    this.$refs.scannerfield.addEventListener('beforeinput', e => e.preventDefault());
            
                    window.addEventListener('keydown', (e) => {
                        const now = Date.now();
                        if (now - this.lastTime > 40) this.buffer = '';
                        this.lastTime = now;
            
                        if (e.key.length === 1) this.buffer += e.key;
            
                        if (e.key === 'Enter') {
                            this.$refs.scannerfield.value = this.buffer;
                            console.log('Scanner:', this.buffer);
                            this.buffer = '';
                        }
                    });
                }
            }">
                <input type="hidden" x-ref="scannerfield" class="input">
                <div class="text-white font-normal flex flex-col items-center justify-center gap-2">
                    <div class="invert h-20 w-20">
                        <img src="https://static.thenounproject.com/png/74445-200.png" alt=""
                            class="h-full w-full object-contain">
                    </div>
                    <h2>Please Scan Ticket</h2>
                </div>
                {{-- <div class="border h-screen pt-10 space-y-10 overflow-y-scroll w-full flex flex-col items-center">
                    <div
                        class="p-10 rounded-xl bg-gradient-to-b from-success from-1% via-[#16281e] via-90% to-[#16281e] to-10% max-w-[400px]">
                        <div class="flex justify-center items-center flex-col gap-2">
                            <x-heroicon-m-check-badge class="h-10 w-10 text-white" />
                            <span class="text-xl font-semibold text-white">Valid Entry</span>
                        </div>
                        <div class="text-center">
                            <h2 class="text-lg font-semibold text-white">Summer Vibes Festival</h2>
                            <span class="text-xs text-white">18 Aug, 2024 &bull; Main Area</span>
                        </div>
                        <div class="mt-5 bg-gray-100 rounded-xl p-5 flex gap-5 items-center">
                            <div class="h-12 w-12 rounded-full overflow-hidden">
                                <img src="https://www.svgrepo.com/show/384670/account-avatar-profile-user.svg"
                                    alt="" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <h2 class="font-semibold text-xs">Ticket Holder</h2>
                                <h3 class="font-bold">Dipesh Murmu</h3>
                            </div>
                            <span class="bg-success/10 text-black font-bold text-xs px-3 py-2 rounded-full">Early
                                Bird</span>
                        </div>
                        <div class="mt-5 pt-5 border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-5 text-white">
                                <div>
                                    <h3 class="text-xs">TICKET ID</h3>
                                    <span class="text-sm font-semibold">TKT9302</span>
                                </div>
                                <div>
                                    <h3 class="text-xs">PURCHASED DATE</h3>
                                    <span class="text-sm font-semibold">29 Aug, 2024</span>
                                </div>
                                <div>
                                    <h3 class="text-xs">TICKET PRICE</h3>
                                    <span class="text-sm font-semibold">Rs. 3,920</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-success w-full rounded-xl h-16">Validate Entry</button>
                        </div>
                    </div>
                    <div
                        class="p-10 rounded-xl bg-gradient-to-b from-success from-1% via-[#16281e] via-90% to-[#16281e] to-10% max-w-[400px]">
                        <div class="flex justify-center items-center flex-col gap-2">
                            <x-heroicon-m-check-badge class="h-10 w-10 text-white" />
                            <span class="text-xl font-semibold text-white">Valid Entry</span>
                        </div>
                        <div class="text-center">
                            <h2 class="text-lg font-semibold text-white">Summer Vibes Festival</h2>
                            <span class="text-xs text-white">18 Aug, 2024 &bull; Main Area</span>
                        </div>
                        <div class="mt-5 bg-gray-100 rounded-xl p-5 flex gap-5 items-center">
                            <div class="h-12 w-12 rounded-full overflow-hidden">
                                <img src="https://www.svgrepo.com/show/384670/account-avatar-profile-user.svg"
                                    alt="" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <h2 class="font-semibold text-xs">Ticket Holder</h2>
                                <h3 class="font-bold">Dipesh Murmu</h3>
                            </div>
                            <span class="bg-success/10 text-black font-bold text-xs px-3 py-2 rounded-full">Early
                                Bird</span>
                        </div>
                        <div class="mt-5 pt-5 border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-5 text-white">
                                <div>
                                    <h3 class="text-xs">TICKET ID</h3>
                                    <span class="text-sm font-semibold">TKT9302</span>
                                </div>
                                <div>
                                    <h3 class="text-xs">PURCHASED DATE</h3>
                                    <span class="text-sm font-semibold">29 Aug, 2024</span>
                                </div>
                                <div>
                                    <h3 class="text-xs">TICKET PRICE</h3>
                                    <span class="text-sm font-semibold">Rs. 3,920</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-success w-full rounded-xl h-16">Validate Entry</button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        {{-- <template x-if="scannerDevice">

        </template> --}}
        <template x-if="cameraScanner">
            <div class="fixed left-0 top-0 h-full w-full">
                <div class="absolute z-50 text-white p-10 top-0 left-0 w-full flex justify-center items-center">
                    <h2 class="font-['poppins'] font-bold text-2xl">festify</h2>
                </div>
                <div id="reader" width="600px"></div>
                <style>
                    #reader video {
                        height: 100vh;
                        object-fit: cover;
                        width: 100%;
                    }
                </style>
            </div>
        </template>
    </div>
</div>
