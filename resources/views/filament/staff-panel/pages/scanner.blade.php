<div>
    @vite(['resources/js/staff/scanner.js', 'resources/css/app.css'])
    <div class="relative">
        <div class="absolute">
            <a class="btn btn-primary" id="startButton">Start</a>
            <a class="button" id="resetButton" class="hidden">Reset</a>
        </div>
        <video id="video" class="h-screen w-full object-cover"></video>
    </div>

    {{-- <div id="sourceSelectPanel" style="display:none">
        <label for="sourceSelect">Change video source:</label>
        <select id="sourceSelect" style="max-width:400px">
        </select>
    </div> --}}

    <div x-data="{
        init() {
            window.addEventListener('load', function() {
                navigator.mediaDevices.getUserMedia({ video: true })
                let selectedDeviceId;
                const codeReader = new BrowserMultiFormatReader;
                codeReader.listVideoInputDevices()
                    .then((videoInputDevices) => {
                        selectedDeviceId = videoInputDevices[0].deviceId
                        {{-- if (videoInputDevices.length >= 1) {
                            const sourceSelect = document.getElementById('sourceSelect')
                            videoInputDevices.forEach((element) => {
                                const sourceOption = document.createElement('option')
                                sourceOption.text = element.label
                                sourceOption.value = element.deviceId
                                sourceSelect.appendChild(sourceOption)
                            })
    
                            sourceSelect.onchange = () => {
                                selectedDeviceId = sourceSelect.value;
                            };
    
                            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                            sourceSelectPanel.style.display = 'block'
                        } --}}
    
                        document.getElementById('startButton').addEventListener('click', () => {
                            codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                                if (result) {
                                    console.log(result)
                                    document.getElementById('result').textContent = result.text
                                }
                                if (err && !(err instanceof ZxingNotFoundException)) {
                                    console.error(err)
                                    document.getElementById('result').textContent = err
                                }
                            })
                            console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
                        })
    
                        document.getElementById('resetButton').addEventListener('click', () => {
                            codeReader.reset()
                            document.getElementById('result').textContent = '';
                            console.log('Reset.')
                        })
    
                    })
                    .catch((err) => {
                        console.error(err)
                    })
            })
        }
    }">

    </div>
</div>
