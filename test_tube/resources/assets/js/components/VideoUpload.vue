<template>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Upload
                    </div>

                    <div class="panel-body">
                        <input type="file" name="video" id="video" @change="fileChanged" v-if='!uploading'> 
                        <div id="video-form" v-if='uploading && !failed'>
                                    hui
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data () {
            return {
                uploading: false,
                uploadigngComplete: false,
                failed: false,
                title: 'Untitled',
                decription: null,
            }
        },

        methods : {
            fileChanged () {
                this.uploading = true;
                this.failed = false;

                this.file = document.getElementById('video').files[0];

                this.store().then(() => {

                })
            },

            store() {
                return this.$http.post('/videos', {
                    title: this.title,
                    description: this.description,
                    extension: this.file.name.split('.').pop
                }).then((response) => {
                    console.log(response.json());
                })    
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
