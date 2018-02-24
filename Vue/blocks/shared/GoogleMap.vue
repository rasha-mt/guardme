<template>
    <div class="address-map fluid h-100 uk-position-relative bg-grey">
        <div class="google-map" :id="mapName" :style="{height : mapHeight + 'px'}"></div>
    </div>
</template>
<style scoped>
    .google-map {
      width: 100%;
      height: 100%;
      margin: 0 auto;
    }
</style>
<script type="text/babel">

    export default{
        data(){
            return{
                mapName: this.name + "-map"
            }
        },
        name: 'google-map',
        props: ['name', 'markers', 'height'],
        mounted: function () {
            this.initMap();
        },
        methods : {
            initMap(){
                if(this.markers && _.isArray(this.markers) && this.markers.length){
                    const element = document.getElementById(this.mapName);
                    const location = this.markers[0];

                    const options = {
                        zoom: 14,
                        center: new google.maps.LatLng(location.latitude, location.longitude)
                    }
                    const map = new google.maps.Map(element, options);

                    this.markers.forEach((coord) => {
                        const position = new google.maps.LatLng(coord.latitude, coord.longitude);
                        const marker = new google.maps.Marker({
                            position,
                            map
                        });
                    });
                }
            }
        },
        watch : {
            markers : function () {
                this.initMap();
            }
        },
        computed : {
            mapHeight : function () {
                return this.height ? this.height : 300;
            }
        }
    }
</script>
