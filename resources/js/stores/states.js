import { defineStore } from 'pinia'


export const useStore = defineStore('states', {
    state: () => {
        return {
            user:[],
            profile:{
                step1:{
                    image:'',
                    fullname:'',
                    residence:'',
                    religious:'',
                    birthday:'',
                    death:'',
                    profession:'',
                    miscellaneous:'',
                    description:''
                },
                step2:{
                    images:[]
                }
            }
        } 
    },
  
 
})