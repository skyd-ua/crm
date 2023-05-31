import './App.css';
import { Admin, ListGuesser, Resource } from 'react-admin';
import jsonServerProvider from 'ra-data-json-server';
import authProvider from './providers/auth.jsx';

const dataProvider = jsonServerProvider('https://jsonplaceholder.typicode.com');
function App() {
    return (
        <Admin dataProvider={ dataProvider } authProvider={authProvider}>
            <Resource name="posts" list={ ListGuesser }/>
            <Resource name="comments" list={ ListGuesser }/>
        </Admin>
    );
}

export default App;
