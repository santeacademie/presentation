import React, { useState } from 'react';

import { useWasm } from './hooks/useWasm';

const App: React.FC = () => {
  const { addFunction } = useWasm();
  const [num1, setNum1] = useState('');
  const [num2, setNum2] = useState('');
  const [result, setResult] = useState<number | undefined>(undefined);

  const handleAddition = () => {
    if (addFunction && num1 && num2) {
      const sum = addFunction(Number(num1), Number(num2));
      setResult(sum);
    }
  };

  return (
    <div className='w-screen h-screen flex flex-col justify-center items-center bg-slate-900 text-white'>
      {addFunction != null ? (
        <>
          <div className='text-black'>
            <input
              type="number"
              value={num1}
              onChange={(e) => setNum1(e.target.value)}
              placeholder="Number 1"
              className="input input-bordered input-primary w-full max-w-xs m-2"
            />
            <input
              type="number"
              value={num2}
              onChange={(e) => setNum2(e.target.value)}
              placeholder="Number 2"
              className="input input-bordered input-primary w-full max-w-xs m-2"
            /></div>

          <button onClick={handleAddition} className="btn btn-primary m-2">
            Add
          </button>
          <div className="m-2">Result: {result !== undefined ? result : 'N/A'}</div>
        </>
      ) : (
        <div>Loading useWasm...</div>
      )}
    </div>
  );
};

export default App;
