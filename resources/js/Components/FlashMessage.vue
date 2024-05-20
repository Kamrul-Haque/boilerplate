<template>
    <div>
        <div v-if="$page.props.flash.success && show"
             class="flex justify-between bg-green-500 bg-opacity-25 rounded-lg p-4 mb-4 text-sm text-success w-full break-all"
             role="alert">
            <div class="flex-1">
                <span class="mdi mdi-check-circle text-lg mr-4"></span>
                {{ $page.props.flash.success }}
            </div>
            <span class="mdi mdi-close-circle-outline text-lg ml-4"
                  @click="show=false"></span>
        </div>
        <div v-if="$page.props.flash.error && show"
             class="flex justify-between bg-red-500 bg-opacity-25 rounded-lg p-4 mb-4 text-sm text-error w-full break-all"
             role="alert">
            <div class="flex-1">
                <span class="mdi mdi-alert-circle text-lg mr-4"></span>
                {{ $page.props.flash.error }}
            </div>
            <span class="mdi mdi-close-circle-outline text-lg ml-4"
                  @click="show=false"></span>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: false,
        }
    },
    watch: {
        '$page.props.flash': {
            handler() {
                this.show = true;
            },
            immediate: true,
            deep: true
        }
    },
    created() {
        setTimeout(() => {
            if (this.show)
                this.show = false;
        }, 4000);
    }
}
</script>
