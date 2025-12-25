<div>
    <div x-data="{
        enable: @entangle('enable_password_change'),
        toggle() {
            this.enable = !this.enable;
        }
    }">
        <div>
            <h2 class="font-bold text-lg">Password</h2>
            <p class="text-white/50">Keep your account secure by using a strong password.</p>
        </div>
        <div class="mt-2 w-fit" @click.outside="enable=false;">
            <button class="btn btn-primary btn-sm" @click="toggle()">Change Password</button>
            <template x-if="enable">
                <div class="mt-5">
                    <form wire:submit.prevent="updatePassword()" class="w-[400px] space-y-5">
                        <x-elements.password label="Current Password" model="current_password" />
                        <x-elements.password label="New Password" model="password" />
                        <x-elements.password label="Confirm Password" model="password_confirmation" />
                        <button class="btn btn-primary btn-sm">Update</button>
                    </form>
                </div>
            </template>
        </div>
    </div>
</div>
