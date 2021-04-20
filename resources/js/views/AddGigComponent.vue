<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                             <div class="card-body">
                                 <button class="btn btn-outline-danger mb-3" @click.prevent="stage=1">Basic Data</button><br>
                                 <button class="btn btn-outline-danger mb-3" @click.prevent="stage=2">Renumeration</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form class="mt-5" @submit.prevent="addGig">
                            <div class="alert alert-danger" v-if="errors.length">
                                <ul class="mb-0">
                                    <li v-for="(error,index) in errors" :key="index">
                                        {{error}}
                                    </li>
                                </ul>
                            </div>
                           <section v-if="stage === 1" class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Role</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Company</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" v-model="gig.role" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" v-model="gig.company" class="form-control">
                                    </div>
                                    <div class="col-md-12 mt-2 mb-2">
                                        <label class="form-label">Location</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <country-select class="form-control" v-model="country" :country="country" topCountry="NG"/>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <region-select class="form-control" v-model="region" :country="country" :region="region"/>
                                    </div>
                                    <div class="col-md-12 mt-4 mb-2">
                                        <input v-model="gig.address" type="text" placeholder="Address" class="form-control">
                                    </div>
                                    <div class="col-md-12 mt-3 mb-2">
                                        Add Tags
                                    </div>
                                    <div class="col-md-12">
                                        <div class='tag-input'>
                                            <div v-for='(tag, index) in tags' :key='tag' class='tag-input__tag' @keydown.enter='addTag'  @keydown.188='addTag'>
                                                <span @click='removeTag(index)'>x</span>
                                                {{ tag }}{{index}}
                                            </div>
                                            <input
                                                v-model="tagid"
                                                type='text'
                                                placeholder="Enter a Tag"
                                                class='tag-input__text'
                                                @keydown.enter='addTag'
                                                @keydown.188='addTag'
                                            /><br>
                                            <small class="text-muted">Suggested tags: Full time, Contract, freelance</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button @click.prevent="stage=2"  class="btn btn-primary float-right mt-2">Continue</button> &nbsp;&nbsp;
                                        <router-link to="/gig"  class="btn btn-default float-right mt-2">Cancel</router-link>
                                    </div>
                           </section>
                            <section  v-if="stage === 2" class="row">
                                <div class="col-md-12 mt-2 mb-2">
                                    <label class="form-label">Salary</label>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <input type="text" v-model="gig.salarymin" class="form-control" placeholder="Minimum">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <input type="text" v-model="gig.salarymax" class="form-control" placeholder="Maximum">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary float-right mt-2">Add Gig</button> &nbsp;&nbsp;
                                    <button class="btn btn-default float-right mt-2" @click.prevent="stage=1">Back</button>
                                </div>
                            </section>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                stage:1,
                country: '',
                region: '',
                tags: ['full time', 'Contract'],
                errors : [],
                gig: {},
                role: '',
                company:'',
                address:'',
                salarymin:'',
                salarymax:'',
                tagid:'',
                gigid: '',
                tag: '',
            };
        },
        methods: {
            // Add tags to the tag input field
            addTag (event) {
                event.preventDefault()
                let val = event.target.value.trim()
                if (val.length > 0) {
                    this.tags.push(val)
                    event.target.value = " "
                }

            },
            removeTag (index) {
                //remove a tag with the x
                this.tags.splice(index, 1)
            },

            addGig(){
                //save gig to the database
                //aswell as save tags
                let url = '/api/gigs';
                let timer = new Date().getTime();
                this.errors = [];
                if(!this.gig.role){
                    this.errors.push('Please enter a role')
                }else if(!this.errors.length){
                    //add all values in formdata for easy insertion to database
                    let formData = new FormData();
                    formData.append('role', this.gig.role);
                    formData.append('company', this.gig.company);
                    formData.append('country', this.country);
                    formData.append('state', this.region);
                    formData.append('address', this.gig.address);
                    formData.append('salarymin', this.gig.salarymin);
                    formData.append('salarymax', this.gig.salarymax);
                    formData.append('tagid', timer);
                    axios.post(url, formData ).then((response) => {
                        if(response.status) {
                            //means a gig has been added
                            //now time to add the tags in the tag table

                            //first add all tags into tagdata
                            //use axios to add tag to table
                            let tagurl = '/api/tags';
                            let tagData = new FormData();
                            for(let t in this.tags){
                                tagData.append('tagid', timer);
                                tagData.append('tag', this.tags[t])
                                axios.post(tagurl, tagData);
                                 tagData = new FormData();
                            }
                            this.$router.push('gig')
                            // alert('successfu')
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'A new gig has been added',
                                showConfirmButton: false,
                                timer: 1500
                            })

                        }else{
                            //alert('failed o');
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            })
                            }
                        }).catch(error => {
                         this.errors.push(error.response.data.error);
                         console.log(this.errors)
                    })
                }
            }
        },
        mounted() {
            this.stage = 1;
            console.log('Component mounted.')
        },

    }
</script>
<style scoped>
        .tag-input {
        width: 100%;
        border: 1px solid #eee;
        font-size: 0.9em;
        height: 50px;
        box-sizing: border-box;
        padding: 0 10px;
        }

        .tag-input__tag {
        height: 30px;
        float: left;
        margin-right: 10px;
        background-color: #eee;
        margin-top: 10px;
        line-height: 30px;
        padding: 0 5px;
        border-radius: 5px;
        }

        .tag-input__tag > span {
        cursor: pointer;
        opacity: 0.75;
        }

        .tag-input__text {
        border: none;
        outline: none;
        font-size: 0.9em;
        line-height: 50px;
        background: none;
        }
</style>
