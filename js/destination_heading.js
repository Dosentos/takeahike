/**
 * Created by Dosentti on 9.5.2017.
 */
var DestinationHeadingClass = React.createClass({
    render: function(){
        return <h3></h3>;
    }
});

var MyComponentClass = React.createClass({
    render: function(){
        return <h1>Hello world</h1>;
    }
});

ReactDOM.render(<DestinationHeadingClass/>, document.getElementById('destination-heading'));